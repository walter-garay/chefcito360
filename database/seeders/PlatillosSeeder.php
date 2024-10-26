<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Platillo;

class PlatillosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Platillo::create([
            'nombre' => 'Ceviche Clásico',
            'descripcion' => 'Delicioso ceviche de pescado fresco',
            'precio' => 20.50,
            'imagen' => null,
            'categoria' => 'entrada',
            'estado' => 'Disponible',
            'comentario' => 'Especialidad de la casa',
            'sucursal_id' => 1,
        ]);

        Platillo::create([
            'nombre' => 'Lomo Saltado',
            'descripcion' => 'Trozos de lomo en salsa criolla con papas fritas',
            'precio' => 25.00,
            'imagen' => null,
            'categoria' => 'principal',
            'estado' => 'Disponible',
            'comentario' => 'Popular entre los clientes',
            'sucursal_id' => 2,
        ]);

        Platillo::create([
            'nombre' => 'Suspiro Limeño',
            'descripcion' => 'Postre tradicional de la gastronomía peruana',
            'precio' => 10.00,
            'imagen' => null,
            'categoria' => 'postre',
            'estado' => 'No disponible',
            'comentario' => 'Postre típico',
            'sucursal_id' => 3,
        ]);

        Platillo::create([
            'nombre' => 'Pisco Sour',
            'descripcion' => 'Bebida nacional de Perú',
            'precio' => 15.00,
            'imagen' => null,
            'categoria' => 'bebida',
            'estado' => 'Disponible',
            'comentario' => 'Cóctel bandera',
            'sucursal_id' => 1,
        ]);

        Platillo::create([
            'nombre' => 'Anticuchos',
            'descripcion' => 'Brochetas de corazón de res a la parrilla',
            'precio' => 18.00,
            'imagen' => null,
            'categoria' => 'entrada',
            'estado' => 'Disponible',
            'comentario' => 'Muy solicitado en las noches',
            'sucursal_id' => 4,
        ]);
    }
}
