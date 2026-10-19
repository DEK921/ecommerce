<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /** Muestra el formulario de registro. */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Registra un nuevo usuario.
     * Los datos llegan ya validados por RegisterRequest.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'password' => $data['password'],   // se encripta con el cast 'hashed' del modelo
            'role'     => User::ROLE_CLIENTE,  // el registro público siempre crea clientes
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route($user->dashboardRoute())
            ->with('success', '¡Tu cuenta se creó correctamente!');
    }
}
