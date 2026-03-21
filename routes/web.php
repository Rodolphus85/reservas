<?php

use App\Http\Controllers\RerservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reservas', [RerservationController::class, 'index']);