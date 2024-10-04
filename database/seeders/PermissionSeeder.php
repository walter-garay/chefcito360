<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'SUPER ADMINISTRADOR']);
        $admin = Role::create(['name' => 'ADMINISTRADOR']);
        $gerente = Role::create(['name' => 'GERENTE']);
        $cajero = Role::create(['name' => 'CAJERO']);
        $mesero = Role::create(['name' => 'MESERO']);
        $cosinero = Role::create(['name' => 'COSINERO']);


        Permission::create(['name' => 'roles.ver'])->syncRoles($admin);
        Permission::create(['name' => 'roles.crear'])->syncRoles($admin);
        Permission::create(['name' => 'roles.editar'])->syncRoles($admin);
        Permission::create(['name' => 'roles.eliminar'])->syncRoles($admin);
        Permission::create(['name' => 'roles.asignar'])->syncRoles($admin);

        Permission::create(['name' => 'permisos.ver'])->syncRoles($admin);
        Permission::create(['name' => 'permisos.crear'])->syncRoles($admin);
        Permission::create(['name' => 'permisos.editar'])->syncRoles($admin);
        Permission::create(['name' => 'permisos.eliminar'])->syncRoles($admin);
        Permission::create(['name' => 'permisos.asignar'])->syncRoles($admin);

        Permission::create(['name' => 'empleados.ver'])->syncRoles($admin);
        Permission::create(['name' => 'empleados.crear'])->syncRoles($admin);
        Permission::create(['name' => 'empleados.editar'])->syncRoles($admin);
        Permission::create(['name' => 'empleados.eliminar'])->syncRoles($admin);
        Permission::create(['name' => 'empleados.asignar'])->syncRoles($admin);

        Permission::create(['name' => 'sucursales.ver'])->syncRoles($admin);
        Permission::create(['name' => 'sucursales.crear'])->syncRoles($admin);
        Permission::create(['name' => 'sucursales.editar'])->syncRoles($admin);
        Permission::create(['name' => 'sucursales.eliminar'])->syncRoles($admin);
        Permission::create(['name' => 'sucursales.asignar'])->syncRoles($admin);

        Permission::create(['name' => 'platillos.ver'])->syncRoles($admin);
        Permission::create(['name' => 'platillos.crear'])->syncRoles($admin);
        Permission::create(['name' => 'platillos.editar'])->syncRoles($admin);
        Permission::create(['name' => 'platillos.eliminar'])->syncRoles($admin);
        Permission::create(['name' => 'platillos.asignar'])->syncRoles($admin);

        Permission::create(['name' => 'proveedores.ver'])->syncRoles($admin);
        Permission::create(['name' => 'proveedores.crear'])->syncRoles($admin);
        Permission::create(['name' => 'proveedores.editar'])->syncRoles($admin);
        Permission::create(['name' => 'proveedores.eliminar'])->syncRoles($admin);
        Permission::create(['name' => 'proveedores.asignar'])->syncRoles($admin);

        Permission::create(['name' => 'inventario.ver'])->syncRoles($admin);
        Permission::create(['name' => 'inventario.crear'])->syncRoles($admin);
        Permission::create(['name' => 'inventario.editar'])->syncRoles($admin);
        Permission::create(['name' => 'inventario.eliminar'])->syncRoles($admin);
        Permission::create(['name' => 'inventario.asignar'])->syncRoles($admin);

        Permission::create(['name' => 'mesas.ver'])->syncRoles($admin);
        Permission::create(['name' => 'mesas.crear'])->syncRoles($admin);
        Permission::create(['name' => 'mesas.editar'])->syncRoles($admin);
        Permission::create(['name' => 'mesas.eliminar'])->syncRoles($admin);
        Permission::create(['name' => 'mesas.asignar'])->syncRoles($admin);
    }
}
