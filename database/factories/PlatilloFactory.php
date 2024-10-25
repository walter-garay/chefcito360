<?php

namespace Database\Factories;

use App\Models\Platillo;
use App\Models\Sucursales;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Platillo>
 */
class PlatilloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(), 
            'descripcion' => $this->faker->sentence(),
            'precio' => $this->faker->randomFloat(2, 5, 100),
            'categoria' => $this->faker->randomElement(['entrada', 'principal', 'postre', 'bebida']),
            'sucursal_id' => Sucursales::factory(),
            'imagen' => null,
        ];
    }
}
