<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'contrasena' => bcrypt('password'),
            'direccion' => $this->faker->address(),
            'telefono' => $this->faker->numerify('########'),
            'email' => $this->faker->unique()->safeEmail(),
            'rol_id' => 2, // El valor predeterminado para rol_id es 2
        ];
    }
}
