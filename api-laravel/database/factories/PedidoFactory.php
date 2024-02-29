<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cantidad' => $this->faker->randomNumber(2),
            'fecha_pedido' => $this->faker->date(),
            'precio_total' => $this->faker->randomNumber(4),
            'usuario_id' => $this->faker->numerify('#'),
            'producto_id' => $this->faker->numerify('#'),
        ];
    }
}
