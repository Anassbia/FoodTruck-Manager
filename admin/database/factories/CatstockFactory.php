<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatstockFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_stock' => Stock::inRandomOrder()->first()?->id ?? Stock::factory(),
            'id_categorie' => Categorie::inRandomOrder()->first()?->id_categorie ?? Categorie::factory(),
        ];
    }
}

