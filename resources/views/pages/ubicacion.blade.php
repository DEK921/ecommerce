@extends('layouts.app')

@section('title', 'Ubicación')

@section('content')
    <div class="card">
        <h1>Ubicación</h1>
        <p><strong>Tienda física:</strong> Av. Central Poniente 123, Centro, Tuxtla Gutiérrez, Chiapas, C.P. 29000.</p>
        <p><strong>Horario:</strong> lunes a sábado de 9:00 a 19:00 h.</p>

        <div style="margin-top:1rem; border-radius:12px; overflow:hidden; border:1px solid var(--borde);">
            <iframe
                title="Mapa de la tienda"
                src="https://www.openstreetmap.org/export/embed.html?bbox=-93.13%2C16.74%2C-93.10%2C16.76&layer=mapnik&marker=16.7528%2C-93.1156"
                style="width:100%; height:340px; border:0;" loading="lazy"></iframe>
        </div>
    </div>
@endsection
