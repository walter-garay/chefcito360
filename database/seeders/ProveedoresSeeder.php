<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedores;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedores::create([
            'nombre' => 'Distribuidora El Buen Sabor',
            'direccion' => 'Av. Siempre Viva 123, Lima',
            'celular' => 987654321,
            'correo' => 'contacto@buen-sabor.com',
            'prov_estado' => 1,
        ]);

        Proveedores::create([
            'nombre' => 'AgroPerú',
            'direccion' => 'Calle Principal 456, Arequipa',
            'celular' => 912345678,
            'correo' => 'ventas@agroperu.com',
            'prov_estado' => 1,
        ]);

        Proveedores::create([
            'nombre' => 'La Gran Granja',
            'direccion' => 'Jr. Libertad 789, Cusco',
            'celular' => 923456789,
            'correo' => 'info@gran-granja.com',
            'prov_estado' => 1,
        ]);

        Proveedores::create([
            'nombre' => 'Frutas del Valle',
            'direccion' => 'Av. Central 321, Trujillo',
            'celular' => 934567890,
            'correo' => 'pedidos@frutasdelvalle.com',
            'prov_estado' => 1,
        ]);

        Proveedores::create([
            'nombre' => 'Pescados del Mar',
            'direccion' => 'Malecón Sur 654, Callao',
            'celular' => 945678901,
            'correo' => 'ventas@pescadosdelmar.com',
            'prov_estado' => 1,
        ]);
    }
}
