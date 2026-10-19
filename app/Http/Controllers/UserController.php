<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * CRUD de usuarios (solo Gerente).
 */
class UserController extends Controller
{
    /** Lista los usuarios con búsqueda y filtro por rol. */
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('buscar'));
        $role   = $request->query('rol');

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when(array_key_exists((string) $role, User::ROLES), fn ($q) => $q->where('role', $role))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        // Totales por rol para las tarjetas de resumen
        $totals = User::selectRaw('role, COUNT(*) as total')
            ->groupBy('role')
            ->pluck('total', 'role');

        return view('usuarios.index', [
            'users'  => $users,
            'totals' => $totals,
            'roles'  => User::ROLES,
            'search' => $search,
            'role'   => $role,
        ]);
    }

    public function create(): View
    {
        return view('usuarios.create', ['roles' => User::ROLES]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        User::create($request->validated());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function show(User $usuario): View
    {
        return view('usuarios.show', ['user' => $usuario]);
    }

    public function edit(User $usuario): View
    {
        return view('usuarios.edit', ['user' => $usuario, 'roles' => User::ROLES]);
    }

    public function update(UserRequest $request, User $usuario): RedirectResponse
    {
        $data = $request->validated();

        // Si la contraseña viene vacía, no se modifica
        if (empty($data['password'])) {
            unset($data['password']);
        }

        // Un gerente no puede quitarse a sí mismo el rol de gerente
        if ($usuario->is($request->user()) && $data['role'] !== User::ROLE_GERENTE) {
            return back()->withInput()
                ->with('error', 'No puedes quitarte tu propio rol de Gerente.');
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Request $request, User $usuario): RedirectResponse
    {
        if ($usuario->is($request->user())) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
