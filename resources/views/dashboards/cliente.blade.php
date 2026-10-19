@extends('layouts.app')

@section('title', 'Panel de cliente')

@section('content')
    <div class="page-head">
        <div>
            <span class="badge badge-cliente">Cliente</span>
            <h1 style="margin-top:.4rem;">Hola, {{ auth()->user()->name }}</h1>
            <p class="muted" style="margin:0;">Desde aquí puedes comprar y revisar tus pedidos.</p>
        </div>
    </div>

    <div class="grid">
        <div class="card option">
            <div class="icon">🛍️</div>
            <h3>Catálogo</h3>
            <p class="muted">Explora café, cacao, miel y artesanías.</p>
        </div>
        <div class="card option">
            <div class="icon">🛒</div>
            <h3>Mi carrito</h3>
            <p class="muted">Revisa los productos que vas a comprar.</p>
        </div>
        <div class="card option">
            <div class="icon">📦</div>
            <h3>Mis pedidos</h3>
            <p class="muted">Consulta el estado de tus compras.</p>
        </div>
        <div class="card option">
            <div class="icon">👤</div>
            <h3>Mi perfil</h3>
            <p class="muted">{{ auth()->user()->email }}</p>
        </div>
    </div>

    <p class="muted" style="margin-top:1.5rem; font-size:.9rem;">Catálogo, carrito y pedidos se habilitarán en la siguiente entrega.</p>
@endsection
