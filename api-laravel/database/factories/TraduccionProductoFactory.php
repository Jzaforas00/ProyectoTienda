<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TraduccionProducto>
 */
class TraduccionProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'producto_id' => $this->faker->numerify('#'),
            'idioma_id' => $this->faker->numerify('#'),
            'nombre_traducido' => $this->faker->name(),
            'descripcion_traducida' => $this->faker->name(),
        ];
    }
}
