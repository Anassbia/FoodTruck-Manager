<?php

namespace Database\Seeders;

use App\Models\Truck;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    public function run()
    {
        Truck::factory(5)->create();
    }
}
