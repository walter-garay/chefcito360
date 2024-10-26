<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Productos;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Productos::create([
            'nombre' => 'Vino Tinto Cabernet',
            'descripcion' => 'Vino tinto de alta calidad, variedad Cabernet Sauvignon',
            'precio_c' => 25.00,
            'precio_v' => 50.00,
            'stock' => 15,
            'categoria' => 'Bebidas',
            'sucursal_id' => 1,
            'cocinero_id' => 2,
            'proveedor_id' => 1,
            'created_at' => '2024-09-27 23:47:16',
        ]);

        Productos::create([
            'nombre' => 'Gaseosa Coca-Cola 1.5L',
            'descripcion' => 'Gaseosa refrescante Coca-Cola en presentación de 1.5 litros',
            'precio_c' => 3.00,
            'precio_v' => 6.00,
            'stock' => 50,
            'categoria' => 'Bebidas',
            'sucursal_id' => 2,
            'cocinero_id' => 3,
            'proveedor_id' => 2,
            'created_at' => '2024-09-27 23:47:16',
        ]);

        Productos::create([
            'nombre' => 'Agua Mineral 500ml',
            'descripcion' => 'Agua mineral sin gas en botella de 500ml',
            'precio_c' => 1.50,
            'precio_v' => 3.00,
            'stock' => 100,
            'categoria' => 'Bebidas',
            'sucursal_id' => 1,
            'cocinero_id' => 4,
            'proveedor_id' => 3,
            'created_at' => '2024-09-27 23:47:16',
        ]);

        Productos::create([
            'nombre' => 'Vino Blanco Chardonnay',
            'descripcion' => 'Vino blanco Chardonnay, fresco y frutal',
            'precio_c' => 30.00,
            'precio_v' => 60.00,
            'stock' => 10,
            'categoria' => 'Bebidas',
            'sucursal_id' => 3,
            'cocinero_id' => 5,
            'proveedor_id' => 4,
            'created_at' => '2024-09-27 23:47:16',
        ]);

        Productos::create([
            'nombre' => 'Gaseosa Sprite 1.5L',
            'descripcion' => 'Gaseosa Sprite de 1.5 litros',
            'precio_c' => 2.80,
            'precio_v' => 5.50,
            'stock' => 40,
            'categoria' => 'Bebidas',
            'sucursal_id' => 2,
            'cocinero_id' => 2,
            'proveedor_id' => 5,
            'created_at' => '2024-09-27 23:47:16',
        ]);
    }
}
