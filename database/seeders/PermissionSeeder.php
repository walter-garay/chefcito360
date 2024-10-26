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
        $admin = Role::create(['name' => 'ADMINISTRADOR']);
        $gerente = Role::create(['name' => 'GERENTE']);
        $cajero = Role::create(['name' => 'CAJERO']);
        $mesero = Role::create(['name' => 'MESERO']);
        $cocinero = Role::create(['name' => 'COCINERO']);


        Permission::create(['name' => 'Roles'])->syncRoles($admin);

        Permission::create(['name' => 'Ver Permisos'])->syncRoles($admin);
        Permission::create(['name' => 'Asignar Permisos'])->syncRoles($admin);

        Permission::create(['name' => 'Empleados ver'])->syncRoles($admin);
        Permission::create(['name' => 'Empleados crear'])->syncRoles($admin);
        Permission::create(['name' => 'Empleados editar'])->syncRoles($admin);
        Permission::create(['name' => 'Empleados eliminar'])->syncRoles($admin);

        Permission::create(['name' => 'Sucursales ver'])->syncRoles($admin);
        Permission::create(['name' => 'Sucursales crear'])->syncRoles($admin);
        Permission::create(['name' => 'Sucursales editar'])->syncRoles($admin);
        Permission::create(['name' => 'Sucursales eliminar'])->syncRoles($admin);

        Permission::create(['name' => 'Platillos ver'])->syncRoles($admin);
        Permission::create(['name' => 'Platillos crear'])->syncRoles($admin);
        Permission::create(['name' => 'Platillos editar'])->syncRoles($admin);
        Permission::create(['name' => 'Platillos eliminar'])->syncRoles($admin);

        Permission::create(['name' => 'Proveedores ver'])->syncRoles($admin);
        Permission::create(['name' => 'Proveedores crear'])->syncRoles($admin);
        Permission::create(['name' => 'Proveedores editar'])->syncRoles($admin);
        Permission::create(['name' => 'Proveedores eliminar'])->syncRoles($admin);

        Permission::create(['name' => 'Inventario ver'])->syncRoles($admin);
        Permission::create(['name' => 'Inventario crear'])->syncRoles($admin);
        Permission::create(['name' => 'Inventario editar'])->syncRoles($admin);
        Permission::create(['name' => 'Inventario eliminar'])->syncRoles($admin);

        Permission::create(['name' => 'Mesas ver'])->syncRoles($admin);
        Permission::create(['name' => 'Mesas crear'])->syncRoles($admin);
        Permission::create(['name' => 'Mesas editar'])->syncRoles($admin);
        Permission::create(['name' => 'Mesas eliminar'])->syncRoles($admin);
    }
}
