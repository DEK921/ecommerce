@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="page-head">
        <div>
            <h1>Usuarios</h1>
            <p class="muted" style="margin:0;">{{ $users->total() }} {{ $users->total() === 1 ? 'usuario encontrado' : 'usuarios encontrados' }}</p>
        </div>
        <a href="{{ route('usuarios.create') }}" class="btn">+ Nuevo usuario</a>
    </div>

    {{-- Resumen por rol --}}
    <div class="grid" style="margin-bottom:1.2rem;">
        @foreach ($roles as $key => $label)
            <div class="card" style="padding:1rem 1.2rem;">
                <span class="badge badge-{{ $key }}">{{ $label }}</span>
                <div class="stat" style="font-size:1.6rem;">{{ $totals[$key] ?? 0 }}</div>
            </div>
        @endforeach
    </div>

    <div class="card">
        {{-- Búsqueda y filtro --}}
        <form method="GET" action="{{ route('usuarios.index') }}" style="display:flex; gap:.6rem; flex-wrap:wrap; margin-bottom:1rem;">
            <div class="field" style="flex:1; min-width:200px; margin:0;">
                <input type="search" name="buscar" value="{{ $search }}" placeholder="Buscar por nombre o correo">
            </div>
            <div class="field" style="margin:0;">
                <select name="rol">
                    <option value="">Todos los roles</option>
                    @foreach ($roles as $key => $label)
                        <option value="{{ $key }}" @selected($role === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn" type="submit">Filtrar</button>
            @if ($search || $role)
                <a href="{{ route('usuarios.index') }}" class="btn btn-light">Limpiar</a>
            @endif
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                        <th>Registro</th>
                        <th style="text-align:right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="muted">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? '—' }}</td>
                            <td><span class="badge badge-{{ $user->role }}">{{ $user->role_name }}</span></td>
                            <td>{{ $user->created_at?->format('d/m/Y') }}</td>
                            <td style="text-align:right;">
                                <a href="{{ route('usuarios.show', $user) }}" class="btn btn-light btn-sm">Ver</a>
                                <a href="{{ route('usuarios.edit', $user) }}" class="btn btn-light btn-sm">Editar</a>
                                @unless ($user->is(auth()->user()))
                                    <form method="POST" action="{{ route('usuarios.destroy', $user) }}" style="display:inline"
                                          onsubmit="return confirm('¿Eliminar a {{ addslashes($user->name) }}? Esta acción no se puede deshacer.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                @endunless
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="muted" style="text-align:center; padding:2rem;">No hay usuarios que coincidan con la búsqueda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        @if ($users->hasPages())
            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:1rem;">
                <span class="muted">Página {{ $users->currentPage() }} de {{ $users->lastPage() }}</span>
                <div style="display:flex; gap:.4rem;">
                    @if ($users->onFirstPage())
                        <span class="btn btn-light btn-sm" style="opacity:.4;">← Anterior</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="btn btn-light btn-sm">← Anterior</a>
                    @endif
                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="btn btn-light btn-sm">Siguiente →</a>
                    @else
                        <span class="btn btn-light btn-sm" style="opacity:.4;">Siguiente →</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection
