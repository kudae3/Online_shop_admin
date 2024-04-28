<?php

namespace Database\Factories;

use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    public function definition(): array
    {
        // $categories = Category::pluck('id')->toArray();
        return [
            'name'=> fake() -> name(),
            'photo' => fake() -> imageUrl(),
            'description' => fake() -> text(80),
            'price' => fake() -> biasedNumberBetween(),
            'view' => fake() -> biasedNumberBetween(),
            // 'category_id' => fake()->randomElement($categories),
            'category_id' => fake()->randomElement(Category::pluck('id'))
            // 'category_id' => $this->faker->randomElement(Category::pluck('id')),

        ];
    }
}
