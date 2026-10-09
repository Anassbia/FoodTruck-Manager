<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    $this->call([
        ServiceJobSeeder::class,
        TypeSeeder::class,
        EmployeeSeeder::class,
        RoleSeeder::class,
        AdminSeeder::class,
        TruckSeeder::class,
        StockSeeder::class,
        MenuSeeder::class,
        ClientSeeder::class,
        TruckSeeder::class,
        MenuSeeder::class,       
        MenuPersSeeder::class,
        OrderSeeder::class,
        NormalOrderSeeder::class,
        WishlistSeeder::class,
        CartSeeder::class,
        CommentaireSeeder::class,
        CategorieSeeder::class,
        CatstockSeeder::class,
        StockmenuSeeder::class,
        StocktruckSeeder::class,
        
    ]);
}
}
