<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    /** Muestra el formulario de inicio de sesión. */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /** Verifica las credenciales e inicia la sesión. */
    public function login(Request $request): RedirectResponse
    {
        // 1. Validar que vengan los datos con el formato correcto
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'Escribe un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // 2. Comparar con la base de datos (Auth::attempt verifica el hash de la contraseña)
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'El correo o la contraseña son incorrectos.',
            ]);
        }

        // 3. Regenerar la sesión para evitar fijación de sesión
        $request->session()->regenerate();

        // 4. Redirigir al dashboard que corresponde al rol del usuario
        $user = Auth::user();

        return redirect()
            ->route($user->dashboardRoute())
            ->with('success', "Bienvenido, {$user->name}.");
    }

    /** Cierra la sesión del usuario. */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Cerraste sesión correctamente.');
    }
}
