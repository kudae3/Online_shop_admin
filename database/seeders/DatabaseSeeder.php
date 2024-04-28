<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\ProductFactory;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        Category::factory(10)->create();
        Product::factory(20)->create();

    }
}
