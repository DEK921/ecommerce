<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /** /dashboard: envía a cada usuario a su panel según el rol. */
    public function redirect(Request $request): RedirectResponse
    {
        return redirect()->route($request->user()->dashboardRoute());
    }

    public function cliente(): View
    {
        return view('dashboards.cliente');
    }

    public function empleado(): View
    {
        return view('dashboards.empleado', [
            'totalClientes' => User::where('role', User::ROLE_CLIENTE)->count(),
        ]);
    }

    public function gerente(): View
    {
        return view('dashboards.gerente', [
            'totalUsuarios'  => User::count(),
            'totalClientes'  => User::where('role', User::ROLE_CLIENTE)->count(),
            'totalEmpleados' => User::where('role', User::ROLE_EMPLEADO)->count(),
            'totalGerentes'  => User::where('role', User::ROLE_GERENTE)->count(),
            'recientes'      => User::latest()->take(5)->get(),
        ]);
    }
}
