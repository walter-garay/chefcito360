<?php

use App\Http\Controllers\Admin\PermisosController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\OrdenesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\SucursalesController;
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



//////////////////////RUTAS DE USUARIOS//////////////////////

// Rutas para roles
Route::resource('roles', RoleController::class)->middleware(['auth', 'can:Roles'])->names('roles');

// Rutas para permisos
Route::middleware(['auth', 'can:permisos.ver'])->get('/permisos', [PermisosController::class, 'index'])->name('permisos.index');
Route::middleware(['auth', 'can:permisos.crear'])->get('/permisos/create', [PermisosController::class, 'create'])->name('permisos.create');
Route::middleware(['auth', 'can:permisos.editar'])->get('/permisos/{id}/edit', [PermisosController::class, 'edit'])->name('permisos.edit');
Route::middleware(['auth', 'can:permisos.eliminar'])->delete('/permisos/{id}', [PermisosController::class, 'destroy'])->name('permisos.destroy');
Route::middleware(['auth', 'can:permisos.asignar'])->post('/permisos/{id}/assign', [PermisosController::class, 'assign'])->name('permisos.assign');

// Rutas para empleados
Route::middleware(['auth', 'can:empleados.ver'])->get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
Route::middleware(['auth', 'can:empleados.crear'])->get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
Route::middleware(['auth', 'can:empleados.editar'])->get('/empleados/{employee}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
Route::middleware(['auth', 'can:empleados.eliminar'])->delete('/empleados/{employee}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
Route::middleware(['auth', 'can:empleados.asignar'])->post('/empleados/{employee}/assign', [EmpleadoController::class, 'assign'])->name('empleados.assign');

Route::resource('platillos', PlatilloController::class);

});
