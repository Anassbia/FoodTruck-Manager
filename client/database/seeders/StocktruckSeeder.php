<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stocktruck;

class StocktruckSeeder extends Seeder
{
    public function run(): void
    {
        Stocktruck::factory()->count(20)->create();
    }
}

