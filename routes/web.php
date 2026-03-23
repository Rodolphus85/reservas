<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Mesas
Route::get('/mesas', [TableController::class, 'index'])->name('tables.index');

Route::post('/mesas', [TableController::class, 'store'])->name('tables.store');

Route::put('/mesas/{id}', [TableController::class, 'update'])->name('tables.update');

Route::delete('/mesas/{id}', [TableController::class, 'destroy'])->name('tables.destroy');

Route::get('/mesas/crear', [TableController::class, 'create'])->name('tables.create');

Route::get('/mesas/{id}/editar', [TableController::class, 'edit'])->name('tables.edit');


// Reservaciones
Route::get('/reservas/crear', [ReservationController::class, 'create'])->name('reservations.create');

Route::post('/reservas', [ReservationController::class, 'store'])->name('reservations.store');