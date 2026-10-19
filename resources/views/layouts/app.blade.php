<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inicio') · {{ config('app.name', 'Mercado Nova') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght@9..144,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --verde: #1f4d3a; --verde-2: #2f6b52; --crema: #f7f3ea; --papel: #fffdf8;
            --tinta: #1d2420; --gris: #6b7570; --borde: #e3ddcf; --acento: #d8893a;
            --ok-bg: #e5f3ea; --ok: #1e6b40; --err-bg: #fbe9e6; --err: #a2332a;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'DM Sans', system-ui, sans-serif; color: var(--tinta); background: var(--crema); line-height: 1.55; }
        a { color: var(--verde-2); }
        h1, h2, h3 { font-family: 'Fraunces', Georgia, serif; font-weight: 600; line-height: 1.2; margin: 0 0 .6rem; }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 16px; }

        /* Barra de navegación */
        .nav { background: var(--verde); color: #fff; }
        .nav .container { display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; padding-top: 14px; padding-bottom: 14px; }
        .brand { font-family: 'Fraunces', serif; font-size: 1.35rem; color: #fff; text-decoration: none; }
        .brand span { color: var(--acento); }
        .nav-links { display: flex; align-items: center; gap: .3rem; flex-wrap: wrap; }
        .nav-links a, .nav-links button { color: #e8efe9; text-decoration: none; padding: .45rem .7rem; border-radius: 8px; font: inherit; font-size: .95rem; background: none; border: 0; cursor: pointer; }
        .nav-links a:hover, .nav-links button:hover, .nav-links a.active { background: rgba(255,255,255,.12); color: #fff; }
        .nav-links .btn-nav { background: var(--acento); color: #fff; font-weight: 500; }
        .nav-links .user-chip { color: #cfe0d6; font-size: .9rem; padding: 0 .5rem; }

        main { padding: 2.2rem 0 3rem; }

        /* Componentes */
        .card { background: var(--papel); border: 1px solid var(--borde); border-radius: 14px; padding: 1.5rem; }
        .grid { display: grid; gap: 1.1rem; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); }
        .btn { display: inline-block; background: var(--verde); color: #fff; border: 0; padding: .65rem 1.15rem; border-radius: 10px; font: inherit; font-weight: 500; text-decoration: none; cursor: pointer; }
        .btn:hover { background: var(--verde-2); }
        .btn-light { background: transparent; color: var(--verde); border: 1px solid var(--verde); }
        .btn-light:hover { background: var(--verde); color: #fff; }
        .btn-danger { background: var(--err); }
        .btn-danger:hover { background: #82271f; }
        .btn-sm { padding: .35rem .7rem; font-size: .85rem; border-radius: 8px; }
        .muted { color: var(--gris); }

        .alert { padding: .8rem 1rem; border-radius: 10px; margin-bottom: 1.2rem; }
        .alert-success { background: var(--ok-bg); color: var(--ok); }
        .alert-error { background: var(--err-bg); color: var(--err); }

        /* Formularios */
        .form-card { max-width: 480px; margin: 0 auto; }
        .field { margin-bottom: 1rem; }
        .field label { display: block; font-weight: 500; margin-bottom: .3rem; font-size: .95rem; }
        .field input, .field select { width: 100%; padding: .65rem .8rem; border: 1px solid var(--borde); border-radius: 9px; font: inherit; background: #fff; }
        .field input:focus, .field select:focus { outline: 2px solid var(--verde-2); outline-offset: 1px; border-color: transparent; }
        .field .is-invalid { border-color: var(--err); background: #fffafa; }
        .error { color: var(--err); font-size: .85rem; margin-top: .25rem; }
        .hint { color: var(--gris); font-size: .82rem; margin-top: .25rem; }
        .check { display: flex; gap: .5rem; align-items: center; font-size: .92rem; }

        /* Tablas */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .95rem; }
        th, td { text-align: left; padding: .7rem .6rem; border-bottom: 1px solid var(--borde); white-space: nowrap; }
        th { font-size: .78rem; text-transform: uppercase; letter-spacing: .04em; color: var(--gris); }
        .badge { display: inline-block; padding: .15rem .6rem; border-radius: 999px; font-size: .78rem; font-weight: 500; }
        .badge-cliente { background: #e3eef8; color: #22507a; }
        .badge-empleado { background: #fdf0de; color: #8a5317; }
        .badge-gerente { background: #e5f3ea; color: #1e6b40; }

        .stat { font-size: 2rem; font-family: 'Fraunces', serif; color: var(--verde); }
        .page-head { display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.4rem; }
        .option { text-decoration: none; color: inherit; transition: transform .15s, box-shadow .15s; }
        .option:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(31,77,58,.10); }
        .option .icon { font-size: 1.6rem; }

        footer { border-top: 1px solid var(--borde); padding: 1.4rem 0; color: var(--gris); font-size: .9rem; }
        nav[role="navigation"] svg { width: 18px; }   /* paginación */
    </style>
</head>
<body>
    <header class="nav">
        <div class="container">
            <a href="{{ route('home') }}" class="brand">Mercado <span>Nova</span></a>

            <nav class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a>
                <a href="{{ route('quienes-somos') }}" class="{{ request()->routeIs('quienes-somos') ? 'active' : '' }}">Quiénes somos</a>
                <a href="{{ route('mision-vision') }}" class="{{ request()->routeIs('mision-vision') ? 'active' : '' }}">Misión y visión</a>
                <a href="{{ route('ubicacion') }}" class="{{ request()->routeIs('ubicacion') ? 'active' : '' }}">Ubicación</a>
                <a href="{{ route('contacto') }}" class="{{ request()->routeIs('contacto') ? 'active' : '' }}">Contáctanos</a>

                @guest
                    <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="btn-nav">Registrarse</a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('*.dashboard') ? 'active' : '' }}">Mi panel</a>
                    @if (auth()->user()->isGerente())
                        <a href="{{ route('usuarios.index') }}" class="{{ request()->routeIs('usuarios.*') ? 'active' : '' }}">Usuarios</a>
                    @endif
                    <span class="user-chip">{{ auth()->user()->name }} · {{ auth()->user()->role_name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn-nav">Cerrar sesión</button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">© {{ date('Y') }} Mercado Nova · Productos locales de Chiapas</div>
    </footer>
</body>
</html>
