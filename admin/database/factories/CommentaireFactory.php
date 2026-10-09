<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
use App\Models\Menu;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commentaire>
 */
class CommentaireFactory extends Factory
{
 

public function definition(): array
{
    return [
        'commentaire' => $this->faker->sentence(8),
        'id_client' => Client::inRandomOrder()->value('id_client') ?? Client::factory(),
        'id_menu' => Menu::inRandomOrder()->value('id_menu') ?? Menu::factory(),
    ];
}

}
