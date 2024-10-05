<?php

use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
/*Route::middleware(['auth', 'can:roles.ver'])->get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::middleware(['auth', 'can:roles.crear'])->get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::middleware(['auth', 'can:roles.editar'])->get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::middleware(['auth', 'can:roles.eliminar'])->delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::middleware(['auth', 'can:roles.asignar'])->post('/roles/{role}/assign', [RoleController::class, 'assign'])->name('roles.assign');

// Rutas para permisos
Route::middleware(['auth', 'can:permisos.ver'])->get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::middleware(['auth', 'can:permisos.crear'])->get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::middleware(['auth', 'can:permisos.editar'])->get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::middleware(['auth', 'can:permisos.eliminar'])->delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
Route::middleware(['auth', 'can:permisos.asignar'])->post('/permissions/{permission}/assign', [PermissionController::class, 'assign'])->name('permissions.assign');
*/
// Rutas para empleados
Route::middleware(['auth', 'can:empleados.ver'])->get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
Route::middleware(['auth', 'can:empleados.crear'])->get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
Route::middleware(['auth', 'can:empleados.editar'])->get('/empleados/{employee}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
Route::middleware(['auth', 'can:empleados.eliminar'])->delete('/empleados/{employee}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
Route::middleware(['auth', 'can:empleados.asignar'])->post('/empleados/{employee}/assign', [EmpleadoController::class, 'assign'])->name('empleados.assign');
});