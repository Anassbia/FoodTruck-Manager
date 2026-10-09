<?php
namespace Database\Factories;

use App\Models\Stock;
use App\Models\MenuPers;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockmenuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_stock' => Stock::inRandomOrder()->first()?->id ?? Stock::factory(),
            'id_menuPers' => MenuPers::inRandomOrder()->first()?->id ?? MenuPers::factory(),
        ];
    }
}

