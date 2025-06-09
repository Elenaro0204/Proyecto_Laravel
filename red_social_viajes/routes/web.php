<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ViajeController;
use App\Http\Controllers\DestinoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Auth;

// Página de inicio: redirige a login
// Route::get('/', function () {
//     if (Auth::check()) {
//         return redirect()->route('index');
//     } else {
//         return redirect()->route('login');
//     }
// })->middleware(['auth', 'verified'])->name('login');

Route::get('/', function () {
    Auth::logout();
    return redirect()->route('login');
});


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Incluye todas las rutas de autenticación de Breeze (login, register, forgot-password, etc.)
require __DIR__ . '/auth.php';

// Rutas para usuarios autenticados
Route::middleware(['auth', 'verified'])->group(function () {
    // Vista principal tras login
    Route::get('/index', [HomeController::class, 'index'])->name('index');

    // CRUD de viajes para usuarios normales
    Route::get('/viajes', [ViajeController::class, 'index'])->name('viajes.index');
    Route::get('/viajes/create', [ViajeController::class, 'create'])->name('viajes.create');
    Route::post('/viajes', [ViajeController::class, 'store'])->name('viajes.store');
    Route::get('/viajes/{viaje}/edit', [ViajeController::class, 'edit'])->name('viajes.edit');
        Route::put('/viajes/{viaje}', [ViajeController::class, 'update'])->name('viajes.update');
    Route::delete('/viajes/{viaje}', [ViajeController::class, 'destroy'])->name('viajes.destroy');

    // CRUD de destinos
    Route::get('destinos', [DestinoController::class, 'index'])->name('destinos.index');
    Route::get('destinos/{destino}', [DestinoController::class, 'create'])->name('destinos.create');

    // Perfil (lo incluye Breeze)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// Rutas exclusivas para admin para modificar destinos
Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Viajes
    Route::get('admin/viajes', [ViajeController::class, 'indexAdmin'])->name('admin.viajes.index');
    Route::get('admin/viajes/create', [ViajeController::class, 'createAdmin'])->name('admin.viajes.create');
    Route::post('admin/viajes', [ViajeController::class, 'storeAdmin'])->name('admin.viajes.store');
    Route::get('admin/viajes/{viaje}/edit', [ViajeController::class, 'editAdmin'])->name('admin.viajes.edit');
    Route::put('admin/viajes/{viaje}', [ViajeController::class, 'updateAdmin'])->name('admin.viajes.update');
    Route::delete('admin/viajes/{viaje}', [ViajeController::class, 'destroyAdmin'])->name('admin.viajes.destroy');

    // Usuarios
    Route::get('admin/users', [AdminController::class, 'indexUser'])->name('admin.users.index');
    Route::get('admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    // Destinos
    Route::get('destinos/create', [DestinoController::class, 'create'])->name('destinos.create');
    Route::post('destinos', [DestinoController::class, 'store'])->name('destinos.store');
    Route::get('destinos/{destino}/edit', [DestinoController::class, 'edit'])->name('destinos.edit');
    Route::put('destinos/{destino}', [DestinoController::class, 'update'])->name('destinos.update');
    Route::delete('destinos/{destino}', [DestinoController::class, 'destroy'])->name('destinos.destroy');
});
