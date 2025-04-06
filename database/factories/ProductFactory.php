<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->words(3, true);
        $price = $this->faker->numberBetween(100, 5000);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => $price,
            'offer_price' => $price * 0.1, // 10% от цены
            'thumb_image' => 'product-' . $this->faker->numberBetween(1, 20) . '.jpg',
            'category_id' => Category::factory(),
            'status' => 1,
            'quantity' => 1,
            'short_description' => $this->faker->sentence(5),
        ];
    }
}


