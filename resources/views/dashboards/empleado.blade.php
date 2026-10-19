@extends('layouts.app')

@section('title', 'Panel de empleado')

@section('content')
    <div class="page-head">
        <div>
            <span class="badge badge-empleado">Empleado</span>
            <h1 style="margin-top:.4rem;">Panel de empleado</h1>
            <p class="muted" style="margin:0;">Bienvenido, {{ auth()->user()->name }}. Estas son tus herramientas de trabajo.</p>
        </div>
        <div class="card" style="padding:1rem 1.4rem;">
            <div class="muted" style="font-size:.85rem;">Clientes registrados</div>
            <div class="stat">{{ $totalClientes }}</div>
        </div>
    </div>

    <div class="grid">
        <div class="card option">
            <div class="icon">📋</div>
            <h3>Pedidos por atender</h3>
            <p class="muted">Prepara y despacha los pedidos de los clientes.</p>
        </div>
        <div class="card option">
            <div class="icon">🏷️</div>
            <h3>Inventario</h3>
            <p class="muted">Actualiza existencias de productos.</p>
        </div>
        <div class="card option">
            <div class="icon">💬</div>
            <h3>Atención a clientes</h3>
            <p class="muted">Responde dudas y solicitudes de devolución.</p>
        </div>
    </div>

    <p class="muted" style="margin-top:1.5rem; font-size:.9rem;">Pedidos e inventario se habilitarán en la siguiente entrega.</p>
@endsection
