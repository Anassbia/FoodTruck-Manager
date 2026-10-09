<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stockmenu;

class StockmenuSeeder extends Seeder
{
    public function run(): void
    {
        Stockmenu::factory()->count(20)->create();
    }
}

