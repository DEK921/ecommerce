@extends('layouts.app')

@section('title', 'Editar usuario')

@section('content')
    <div class="card form-card">
        <h1>Editar usuario</h1>
        <p class="muted">{{ $user->email }}</p>

        <form method="POST" action="{{ route('usuarios.update', $user) }}" novalidate>
            @csrf
            @method('PUT')
            @include('usuarios._form')

            <div style="display:flex; gap:.6rem;">
                <button type="submit" class="btn">Guardar cambios</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
