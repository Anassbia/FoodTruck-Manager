<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
use App\Models\Menu;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
   

public function definition(): array
{
    $menu = Menu::inRandomOrder()->first()->id ?? 1;
    $client = Client::inRandomOrder()->first()->id ?? 1;
    return [
        'quantite' => $this->faker->numberBetween(1, 5),
        'id_client' => $client,
        'id_menu' => $menu,
    ];
}

}
