@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')
    <div class="card form-card">
        <h1>Crear una cuenta</h1>
        <p class="muted">Regístrate como cliente para hacer pedidos.</p>

        @if ($errors->any())
            <div class="alert alert-error">Revisa los campos marcados en rojo.</div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" novalidate>
            @csrf

            <div class="field">
                <label for="name">Nombre completo</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       class="@error('name') is-invalid @enderror" autocomplete="name" required>
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="email">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="@error('email') is-invalid @enderror" autocomplete="email" required>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="phone">Teléfono <span class="muted">(opcional)</span></label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                       class="@error('phone') is-invalid @enderror" placeholder="9611234567" autocomplete="tel">
                @error('phone') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password"
                       class="@error('password') is-invalid @enderror" autocomplete="new-password" required>
                <div class="hint">Mínimo 8 caracteres, con mayúsculas, minúsculas y al menos un número.</div>
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required>
            </div>

            <div class="field">
                <label class="check">
                    <input type="checkbox" name="terms" value="1" style="width:auto;" {{ old('terms') ? 'checked' : '' }}>
                    Acepto los términos y condiciones
                </label>
                @error('terms') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn" style="width:100%;">Registrarme</button>
        </form>

        <p class="muted" style="margin-top:1.2rem; text-align:center;">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </p>
    </div>
@endsection
