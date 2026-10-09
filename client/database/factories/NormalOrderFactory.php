<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;  // Make sure the Client model is included
use App\Models\Menu;

class NormalOrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date_order' => $this->faker->date(),
            'quantity' => rand(1, 15),
            'paiement_type' => $this->faker->randomElement(['cash', 'card', 'paypal']),
            'id_truck' => rand(1, 2),
            'id_menu' => rand(1, 2),
            
            
        ];
    }
}

