@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="card form-card">
        <span class="badge badge-{{ $user->role }}">{{ $user->role_name }}</span>
        <h1 style="margin-top:.5rem;">{{ $user->name }}</h1>

        <table style="margin:1rem 0;">
            <tr><th>ID</th><td>{{ $user->id }}</td></tr>
            <tr><th>Correo</th><td>{{ $user->email }}</td></tr>
            <tr><th>Teléfono</th><td>{{ $user->phone ?? '—' }}</td></tr>
            <tr><th>Registrado</th><td>{{ $user->created_at?->format('d/m/Y H:i') }}</td></tr>
            <tr><th>Actualizado</th><td>{{ $user->updated_at?->format('d/m/Y H:i') }}</td></tr>
        </table>

        <div style="display:flex; gap:.6rem;">
            <a href="{{ route('usuarios.edit', $user) }}" class="btn">Editar</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-light">Volver</a>
        </div>
    </div>
@endsection
