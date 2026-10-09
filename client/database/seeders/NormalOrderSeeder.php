<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NormalOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NormalOrderSeeder extends Seeder
{
    public function run()
    {
        NormalOrder::factory(10)->create();
    }
}
