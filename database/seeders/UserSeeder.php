<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'ADMINISTRADOR',
            'email' => 'admin@chefcito.com',
            'password' => bcrypt('123456789'),
        ])->assignRole('ADMINISTRADOR');

        User::create([
            'name' => 'GERENTE',
            'email' => 'gerente@chefcito.com',
            'password' => bcrypt('123456789'),
        ])->assignRole('GERENTE');

    }
}
