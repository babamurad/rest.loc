<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'slug' => fake()->slug(),
            'thumb_image' => '/uploads/test.jpg',
            'category_id' => fake()->numberBetween(1, 5),
            'short_description' => fake()->paragraph(),
            'long_description' => fake()->text(),
            'price' => fake()->randomFloat(2, 10, 200),
            'offer_price' => fake()->randomFloat(2, 1, 100),
            'sku' => fake()->unique()->ean13(),
            'seo_title' => fake()->sentence(),
            'seo_description' => fake()->paragraph(),
            'status' => fake()->boolean(),
            'show_at_home' => fake()->boolean(),
            'is_featured' => fake()->boolean(),
            ];
    }
}
