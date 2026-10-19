@extends('layouts.app')

@section('title', 'Nuevo usuario')

@section('content')
    <div class="card form-card">
        <h1>Nuevo usuario</h1>
        <p class="muted">Como gerente puedes crear clientes, empleados u otros gerentes.</p>

        <form method="POST" action="{{ route('usuarios.store') }}" novalidate>
            @csrf
            @include('usuarios._form')

            <div style="display:flex; gap:.6rem;">
                <button type="submit" class="btn">Guardar</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
