<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuPers;

class MenuPersSeeder extends Seeder
{
   
    public function run(): void
    {
        MenuPers::factory(10)->create();
    }
}
