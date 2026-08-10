<?php

namespace Database\Factories;

use App\Models\Habit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Habit>
 */
class HabitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $habits = [
            'Exercitar-se',
            'Ler um livro',
            'Meditar',
            'Beber água',
            'Dormir cedo',
            'Praticar um hobby',
            'Escrever em um diário',
            'Aprender uma nova habilidade',
            'Cozinhar uma refeição saudável',
            'Dar uma volta',
        ];
        return [
            'user_id' => 1,
            'name' => $this->faker->unique()->randomElement($habits),
        ];
    }
}
