<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\OrdenesController;
use App\Http\Controllers\Admin\PermisosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\VentasController;

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

});


//////////////////////RUTAS DE USUARIOS//////////////////////

// Rutas para roles
Route::resource('roles', RoleController::class)->middleware(['auth', 'can:Roles'])->names('roles');

// Rutas para permisos
Route::resource('permisos', PermisosController::class)->middleware(['auth', 'can:Ver Permisos', 'can:Asignar Permisos'])->names('permisos');

// Rutas para empleados 
Route::resource('empleados', EmpleadoController::class)->middleware(['auth'])->names('empleados');

// Rutas para la gestión de platillos
Route::resource('platillos', PlatilloController::class)->middleware(['auth'])->names('platillos');
Route::resource('proveedores', ProveedoresController::class)->middleware(['auth'])->names('proveedores');
Route::resource('productos', ProductosController::class)->middleware(['auth'])->names('productos');
Route::resource('sucursales', SucursalesController::class)->middleware(['auth'])->names('sucursales');
Route::resource('mesas', MesaController::class)->middleware(['auth'])->names('mesas');
Route::resource('ventas', VentasController::class)->middleware(['auth'])->names('ventas');
Route::resource('ordenes', OrdenesController::class)->middleware(['auth'])->names('ordenes');
