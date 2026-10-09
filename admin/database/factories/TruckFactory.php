<?php

namespace Database\Factories;

use App\Models\Truck;
use Illuminate\Database\Eloquent\Factories\Factory;

class TruckFactory extends Factory
{
    protected $model = Truck::class;

    public function definition()
    {
        return [
            'matricule' => $this->faker->unique()->numerify('TRK#####'),
            'type' => $this->faker->word(),
            'password' => $this->faker->word(),
            'localisation' => $this->faker->city(),
            'status' => $this->faker->randomElement([1, 2]),
        ];
    }
}
