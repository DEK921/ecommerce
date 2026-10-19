{{-- Campos compartidos por create y edit. Recibe $user (opcional) y $roles. --}}
@php($editing = isset($user))

<div class="field">
    <label for="name">Nombre completo</label>
    <input id="name" type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
           class="@error('name') is-invalid @enderror" required>
    @error('name') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="email">Correo electrónico</label>
    <input id="email" type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
           class="@error('email') is-invalid @enderror" required>
    @error('email') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="phone">Teléfono <span class="muted">(opcional)</span></label>
    <input id="phone" type="tel" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
           class="@error('phone') is-invalid @enderror" placeholder="9611234567">
    @error('phone') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="role">Rol</label>
    <select id="role" name="role" class="@error('role') is-invalid @enderror" required>
        @foreach ($roles as $key => $label)
            <option value="{{ $key }}" @selected(old('role', $user->role ?? 'cliente') === $key)>{{ $label }}</option>
        @endforeach
    </select>
    @error('role') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="password">Contraseña @if($editing)<span class="muted">(déjala vacía para no cambiarla)</span>@endif</label>
    <input id="password" type="password" name="password" autocomplete="new-password"
           class="@error('password') is-invalid @enderror" {{ $editing ? '' : 'required' }}>
    <div class="hint">Mínimo 8 caracteres, con mayúsculas, minúsculas y al menos un número.</div>
    @error('password') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="password_confirmation">Confirmar contraseña</label>
    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password">
</div>
