<?php

namespace Database\Seeders;

use App\Models\Sucursales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Sucursales::create([
            'nombre' => 'Chefcito 1',
            'direccion' => 'Calle 1 #123',
            'tipo_sucursal' => 'secundaria',
            'celular' => 925651145,
            'whatsapp' => 954452152,
            'serie' => 2,
            'suc_estado' => 1,
        ]);
    }
}
