<?php

use App\Http\Controllers\Admin\PermisosController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\EmpleadoController;
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


//////////////////////RUTAS DE USUARIOS//////////////////////

// Rutas para roles /**/
Route::middleware(['auth', 'can:roles.ver'])->get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::middleware(['auth', 'can:roles.crear'])->get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::middleware(['auth', 'can:roles.editar'])->get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::middleware(['auth', 'can:roles.eliminar'])->delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::middleware(['auth', 'can:roles.asignar'])->post('/roles/{id}/assign', [RoleController::class, 'assign'])->name('roles.assign');

// Rutas para permisos
Route::middleware(['auth', 'can:permisos.ver'])->get('/permisos', [PermisosController::class, 'index'])->name('permisos.index');
Route::middleware(['auth', 'can:permisos.crear'])->get('/permisos/create', [PermisosController::class, 'create'])->name('permisos.create');
Route::middleware(['auth', 'can:permisos.editar'])->get('/permisos/{id}/edit', [PermisosController::class, 'edit'])->name('permisos.edit');
Route::middleware(['auth', 'can:permisos.eliminar'])->delete('/permisos/{id}', [PermisosController::class, 'destroy'])->name('permisos.destroy');
Route::middleware(['auth', 'can:permisos.asignar'])->post('/permisos/{id}/assign', [PermisosController::class, 'assign'])->name('permisos.assign');

// Rutas para empleados
Route::middleware(['auth', 'can:empleados.ver'])->get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
Route::middleware(['auth', 'can:empleados.crear'])->get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
Route::middleware(['auth', 'can:empleados.editar'])->get('/empleados/{id}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
Route::middleware(['auth', 'can:empleados.eliminar'])->delete('/empleados/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
Route::middleware(['auth', 'can:empleados.asignar'])->post('/empleados/{id}/assign', [EmpleadoController::class, 'assign'])->name('empleados.assign');

