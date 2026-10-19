@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <section class="card" style="padding:2.5rem; margin-bottom:1.5rem; background:linear-gradient(135deg,#fffdf8 60%,#f3e7d3);">
        <p class="muted" style="margin:0 0 .4rem; text-transform:uppercase; letter-spacing:.08em; font-size:.8rem;">Tienda en línea</p>
        <h1 style="font-size:2.4rem; max-width:620px;">Café, cacao y artesanías de Chiapas, directo a tu puerta.</h1>
        <p class="muted" style="max-width:560px;">En Mercado Nova reunimos a productores locales en un solo lugar. Crea tu cuenta para hacer pedidos y dar seguimiento a tus compras.</p>

        <div style="display:flex; gap:.7rem; flex-wrap:wrap; margin-top:1.2rem;">
            @guest
                <a href="{{ route('register') }}" class="btn">Crear una cuenta</a>
                <a href="{{ route('login') }}" class="btn btn-light">Ya tengo cuenta</a>
            @else
                <a href="{{ route('dashboard') }}" class="btn">Ir a mi panel</a>
            @endguest
        </div>
    </section>

    <div class="grid">
        <a href="{{ route('quienes-somos') }}" class="card option">
            <div class="icon">🌱</div>
            <h3>Quiénes somos</h3>
            <p class="muted">Conoce nuestra historia y a los productores con los que trabajamos.</p>
        </a>
        <a href="{{ route('mision-vision') }}" class="card option">
            <div class="icon">🎯</div>
            <h3>Misión y visión</h3>
            <p class="muted">Lo que nos mueve y hacia dónde vamos.</p>
        </a>
        <a href="{{ route('ubicacion') }}" class="card option">
            <div class="icon">📍</div>
            <h3>Ubicación</h3>
            <p class="muted">Visita nuestra tienda física en Tuxtla Gutiérrez.</p>
        </a>
        <a href="{{ route('contacto') }}" class="card option">
            <div class="icon">✉️</div>
            <h3>Contáctanos</h3>
            <p class="muted">Teléfono, correo y horarios de atención.</p>
        </a>
    </div>
@endsection
