<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // valeur par défaut
            'birthday' => $this->faker->date('Y-m-d', '2005-01-01'),
            'phone' => '06' . rand(10000000, 99999999),
            'points' => rand(0, 1000),
        ];
    }
}

