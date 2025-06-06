<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ViajeController;
use App\Http\Controllers\DestinoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

// Página de inicio: redirige a login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Incluye todas las rutas de autenticación de Breeze (login, register, forgot-password, etc.)
require __DIR__ . '/auth.php';

// Rutas para usuarios autenticados
Route::middleware(['auth', 'verified'])->group(function () {
    // Vista principal tras login
    Route::get('/dashboard', function () {
        return redirect()->route('viajes.index');
    })->name('dashboard');

    // CRUD de viajes para usuarios normales
    Route::get('/viajes', [ViajeController::class, 'index'])->name('viajes.index');
    Route::get('/viajes/create', [ViajeController::class, 'create'])->name('viajes.create');
    Route::post('/viajes', [ViajeController::class, 'store'])->name('viajes.store');

    // CRUD de destinos (puedes limitar esto a admin si lo prefieres)
    Route::get('destinos', [DestinoController::class, 'index'])->name('destinos.index');
    Route::get('destinos/{destino}', [DestinoController::class, 'show'])->name('destinos.show');

    // Perfil (opcional, lo incluye Breeze)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas exclusivas para admin para modificar destinos
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('destinos/create', [DestinoController::class, 'create'])->name('destinos.create');
    Route::post('destinos', [DestinoController::class, 'store'])->name('destinos.store');
    Route::get('destinos/{destino}/edit', [DestinoController::class, 'edit'])->name('destinos.edit');
    Route::put('destinos/{destino}', [DestinoController::class, 'update'])->name('destinos.update');
    Route::delete('destinos/{destino}', [DestinoController::class, 'destroy'])->name('destinos.destroy');

    // También tienes rutas admin como esta:
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
