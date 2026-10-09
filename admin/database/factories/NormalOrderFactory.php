<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NormalOrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date_order' => $this->faker->date(),
            'quantity' => rand(1, 15),
            'paiement_type' => $this->faker->randomElement(['cash', 'card', 'paypal']),
            'id_menu' => rand(1, 5),
            'id_truck' => rand(1, 2),
        ];
    }
}

