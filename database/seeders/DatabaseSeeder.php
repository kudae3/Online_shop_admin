<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Favourite;
use Illuminate\Database\Seeder;
use Database\Factories\ProductFactory;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        Category::factory(5)->create();
        Product::factory(10)->create();
        User::factory(7)->create();
        Order::factory(10)->create();
        Favourite::factory(5)->create();

    }
}
