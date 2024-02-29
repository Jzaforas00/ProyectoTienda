<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'precio' => $this->faker->randomNumber(3),
            'stock' => $this->faker->randomNumber(2),
            'imagen_url' => $this->faker->url(),
            'categoria_id' => $this->faker->numerify('#'),
        ];
    }
}
