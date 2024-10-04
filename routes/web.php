<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatilloController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas por autenticación (Jetstream)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas para la gestión de platillos
    Route::resource('platillos', PlatilloController::class);
});
