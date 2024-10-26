<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario ADMINISTRADOR
        User::create([
            'name' => 'ADMINISTRADOR',
            'email' => 'admin@chefcito.com',
            'password' => bcrypt('123456789'),
            'email_verified_at' => now(),
        ])->assignRole('ADMINISTRADOR');

        // Crear usuario GERENTE
        User::create([
            'name' => 'GERENTE',
            'email' => 'gerente@chefcito.com',
            'password' => bcrypt('123456789'),
            'email_verified_at' => now(),
        ])->assignRole('GERENTE');

        DB::table('user_sucursal')->insert([
            'empleado_id' => 1,
            'sucursal_id' => 1,
        ]);

        DB::table('user_sucursal')->insert([
            'empleado_id' => 2,
            'sucursal_id' => 1,
        ]);

    }
}
