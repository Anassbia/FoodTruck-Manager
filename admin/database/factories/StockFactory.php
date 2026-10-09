<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement([1, 2]),
            'id_type' => Type::query()->inRandomOrder()->value('id_type') ?? Type::factory(),
        ];
    }
}
