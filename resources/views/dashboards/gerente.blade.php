@extends('layouts.app')

@section('title', 'Panel de gerente')

@section('content')
    <div class="page-head">
        <div>
            <span class="badge badge-gerente">Gerente</span>
            <h1 style="margin-top:.4rem;">Panel de administración</h1>
            <p class="muted" style="margin:0;">Bienvenido, {{ auth()->user()->name }}.</p>
        </div>
        <a href="{{ route('usuarios.create') }}" class="btn">+ Nuevo usuario</a>
    </div>

    <div class="grid" style="margin-bottom:1.5rem;">
        <div class="card"><div class="muted">Usuarios totales</div><div class="stat">{{ $totalUsuarios }}</div></div>
        <div class="card"><div class="muted">Clientes</div><div class="stat">{{ $totalClientes }}</div></div>
        <div class="card"><div class="muted">Empleados</div><div class="stat">{{ $totalEmpleados }}</div></div>
        <div class="card"><div class="muted">Gerentes</div><div class="stat">{{ $totalGerentes }}</div></div>
    </div>

    <div class="grid" style="margin-bottom:1.5rem;">
        <a href="{{ route('usuarios.index') }}" class="card option">
            <div class="icon">👥</div>
            <h3>Gestión de usuarios</h3>
            <p class="muted">Crear, consultar, editar y eliminar usuarios.</p>
        </a>
        <div class="card option">
            <div class="icon">📈</div>
            <h3>Reportes de ventas</h3>
            <p class="muted">Disponible en la siguiente entrega.</p>
        </div>
        <div class="card option">
            <div class="icon">⚙️</div>
            <h3>Configuración de la tienda</h3>
            <p class="muted">Disponible en la siguiente entrega.</p>
        </div>
    </div>

    <div class="card">
        <h3>Últimos registros</h3>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Nombre</th><th>Correo</th><th>Rol</th><th>Alta</th></tr></thead>
                <tbody>
                    @foreach ($recientes as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td><span class="badge badge-{{ $u->role }}">{{ $u->role_name }}</span></td>
                            <td>{{ $u->created_at?->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
