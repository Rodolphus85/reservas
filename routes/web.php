<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    // Mesas
    Route::middleware('can:admin')->group(function () {
        Route::get('/mesas', [TableController::class, 'index'])->name('tables.index');

        Route::post('/mesas', [TableController::class, 'store'])->name('tables.store');

        Route::put('/mesas/{id}', [TableController::class, 'update'])->name('tables.update');

        Route::delete('/mesas/{id}', [TableController::class, 'destroy'])->name('tables.destroy');

        Route::get('/mesas/crear', [TableController::class, 'create'])->name('tables.create');

        Route::get('/mesas/{id}/editar', [TableController::class, 'edit'])->name('tables.edit');
    });

    // Reservaciones
    Route::get('/reservas/crear', [ReservationController::class, 'create'])
        ->name('reservations.create');

    Route::post('/reservas', [ReservationController::class, 'store'])->name('reservations.store');

    Route::middleware('can:admin')->group(function () {
        Route::get('/reservas', [ReservationController::class, 'index'])
            ->name('reservations.index');
    });
});

// Login
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('auth.login');

Route::post('/login', LoginController::class)
    ->middleware('guest')
    ->name('login');


// Logout
Route::post('/logout', LogoutController::class)
    ->middleware('auth')
    ->name('logout');

// Registración
Route::view('/registracion', 'auth.register')
    ->middleware('guest')
    ->name('auth.register');

Route::post('/register', RegisterController::class)
    ->middleware('guest')
    ->name('register');
