<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'image' => $this->faker->imageUrl(),
            'reduction' => $this->faker->numberBetween(5, 20),
            'status' => $this->faker->randomElement([1, 2]),
        ];
    }
}
