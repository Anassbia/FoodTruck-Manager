<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Catstock;

class CatstockSeeder extends Seeder
{
    public function run(): void
    {
        Catstock::factory()->count(20)->create();
    }
}
