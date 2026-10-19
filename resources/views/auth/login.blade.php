
@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
    <div class="card form-card">
        <h1>Iniciar sesión</h1>
        <p class="muted">Entra con tu correo y contraseña.</p>

        <form method="POST"
              action="{{ route('login.attempt') }}"
              aria-describedby="login-errors">
            @csrf

            @if ($errors->any())
                <div id="login-errors"
                     class="error"
                     role="alert"
                     aria-live="assertive"
                     tabindex="-1">
                    <p><strong>No se pudo iniciar sesión.</strong></p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="field">
                <label for="email">Correo electrónico</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="@error('email') is-invalid @enderror"
                    autocomplete="email"
                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                    @error('email') aria-describedby="email-error" @enderror
                    required
                    autofocus
                >

                @error('email')
                    <div id="email-error" class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Contraseña</label>

                <div class="password-wrapper">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="@error('password') is-invalid @enderror"
                        autocomplete="current-password"
                        aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                        @error('password') aria-describedby="password-error" @enderror
                        required
                    >

                    <button
                        type="button"
                        id="toggle-password"
                        class="btn"
                        aria-controls="password"
                        aria-pressed="false"
                    >
                        Mostrar contraseña
                    </button>
                </div>

                @error('password')
                    <div id="password-error" class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label class="check" for="remember">
                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        style="width:auto;"
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    Recordarme
                </label>
            </div>

            <button type="submit" class="btn" style="width:100%;">
                Entrar
            </button>
        </form>

        <p class="muted" style="margin-top:1.2rem; text-align:center;">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}">Regístrate aquí</a>
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('toggle-password');

            if (!passwordInput || !toggleButton) {
                return;
            }

            toggleButton.addEventListener('click', function () {
                const isPasswordHidden = passwordInput.type === 'password';

                passwordInput.type = isPasswordHidden ? 'text' : 'password';

                toggleButton.textContent = isPasswordHidden
                    ? 'Ocultar contraseña'
                    : 'Mostrar contraseña';

                toggleButton.setAttribute(
                    'aria-pressed',
                    isPasswordHidden ? 'true' : 'false'
                );
            });
        });
    </script>
@endsection
