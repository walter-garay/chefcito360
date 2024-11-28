<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sucursales;

class SucursalesSeeder extends Seeder
{

    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sucursales::insert([
            [
                'nombre' => 'Sucursal Central Lima',
                'tipo_sucursal' => 'central',
                'celular' => 999111222,
                'direccion' => 'Av. Principal 123, Lima',
                'whatsapp' => 999333444,
                'serie' => 'SC001',
                'suc_estado' => 1,
                'gerente_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sucursal Surco',
                'tipo_sucursal' => 'secundaria',
                'celular' => 999222333,
                'direccion' => 'Calle Comercio 456, Surco',
                'whatsapp' => 999555666,
                'serie' => 'SC002',
                'suc_estado' => 1,
                'gerente_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sucursal Miraflores',
                'tipo_sucursal' => 'secundaria',
                'celular' => 999333444,
                'direccion' => 'Av. Pardo y Aliaga 789, Miraflores',
                'whatsapp' => 999777888,
                'serie' => 'SC003',
                'suc_estado' => 1,
                'gerente_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sucursal Callao',
                'tipo_sucursal' => 'secundaria',
                'celular' => 999444555,
                'direccion' => 'Jr. Callao 123, Callao',
                'whatsapp' => 999111333,
                'serie' => 'SC004',
                'suc_estado' => 1,
                'gerente_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sucursal San Isidro',
                'tipo_sucursal' => 'central',
                'celular' => 999555666,
                'direccion' => 'Av. Javier Prado 456, San Isidro',
                'whatsapp' => 999444222,
                'serie' => 'SC005',
                'suc_estado' => 1,
                'gerente_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
