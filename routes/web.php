<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Páginas públicas (cualquier visitante, con o sin sesión)
|--------------------------------------------------------------------------
*/
Route::view('/', 'pages.home')->name('home');
Route::view('/quienes-somos', 'pages.quienes-somos')->name('quienes-somos');
Route::view('/mision-vision', 'pages.mision-vision')->name('mision-vision');
Route::view('/ubicacion', 'pages.ubicacion')->name('ubicacion');
Route::view('/contacto', 'pages.contacto')->name('contacto');

/*
|--------------------------------------------------------------------------
| Solo invitados (si ya inició sesión, se le manda a su dashboard)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])
        ->middleware('throttle:5,1')   // máx. 5 intentos por minuto
        ->name('login.attempt');

    Route::get('/registro', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/registro', [RegisterController::class, 'register'])->name('register.store');
});

/*
|--------------------------------------------------------------------------
| Usuarios autenticados
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Redirige al dashboard correcto según el rol
    Route::get('/dashboard', [DashboardController::class, 'redirect'])->name('dashboard');

    // Cliente
    Route::get('/cliente/dashboard', [DashboardController::class, 'cliente'])
        ->middleware('role:cliente')
        ->name('cliente.dashboard');

    // Empleado
    Route::get('/empleado/dashboard', [DashboardController::class, 'empleado'])
        ->middleware('role:empleado')
        ->name('empleado.dashboard');

    // Gerente: dashboard + CRUD de usuarios
    Route::middleware('role:gerente')->group(function () {
        Route::get('/gerente/dashboard', [DashboardController::class, 'gerente'])
            ->name('gerente.dashboard');

        Route::resource('usuarios', UserController::class);
    });
});
