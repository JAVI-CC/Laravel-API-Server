<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Juego>
 */
class JuegoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->name(),
            'descripcion' => fake()->text(),
            'fecha' => fake()->dateTimeBetween()->format('Y-m-d'),
            'slug' => fake()->unique()->slug(),
            'url_imagen' => fake()->unique()->url()
        ];
    }
}