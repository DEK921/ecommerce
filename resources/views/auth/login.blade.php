@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
    <div class="card form-card">
        <h1>Iniciar sesión</h1>
        <p class="muted">Entra con tu correo y contraseña.</p>

        <form method="POST" action="{{ route('login.attempt') }}" novalidate>
            @csrf

            <div class="field">
                <label for="email">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="@error('email') is-invalid @enderror" autocomplete="email" autofocus required>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password"
                       class="@error('password') is-invalid @enderror" autocomplete="current-password" required>
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label class="check">
                    <input type="checkbox" name="remember" style="width:auto;" {{ old('remember') ? 'checked' : '' }}>
                    Recordarme
                </label>
            </div>

            <button type="submit" class="btn" style="width:100%;">Entrar</button>
        </form>

        <p class="muted" style="margin-top:1.2rem; text-align:center;">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
        </p>
    </div>
@endsection
