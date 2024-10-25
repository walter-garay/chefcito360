<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sucursales>
 */
class SucursalesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company,
            'tipo_sucursal' => $this->faker->randomElement(['central', 'secundaria']), 
            'celular' => $this->faker->optional()->numerify('#########'),
            'direccion' => $this->faker->address,
            'whatsapp' => $this->faker->optional()->numerify('#########'),
            'serie' => strtoupper($this->faker->bothify('???###')),
            'gerente_id' => 1,
        ];
    }
}
