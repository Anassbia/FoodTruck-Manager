<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date_order' => $this->faker->date(),
            'quantity' => rand(1, 15),
            'paiement_type' => $this->faker->randomElement(['cash', 'card', 'points']),
            'id_menu' => rand(1, 5),
            'id_client' => rand(1, 5),
        ];
    }
}

