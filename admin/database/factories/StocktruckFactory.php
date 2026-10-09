<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\Truck;
use Illuminate\Database\Eloquent\Factories\Factory;

class StocktruckFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_stock' => Stock::inRandomOrder()->first()?->id ?? Stock::factory(),
            'id_truck' => Truck::inRandomOrder()->first()?->id ?? Truck::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}

