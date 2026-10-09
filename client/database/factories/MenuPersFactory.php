<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuPersFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Menu ' . $this->faker->word(),
            'date_order' => $this->faker->date(),
            'paiement_type' => $this->faker->randomElement(['cash', 'card', 'points']),
            'quantity' => rand(1, 15),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'id_client' => rand(1, 5),
        ];
    }
}

