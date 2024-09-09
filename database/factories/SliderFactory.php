<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => 'uploads/sliders/slider1.jpg',
            'offer' => '20%',
            'title' => fake()->sentence(6),
            'description' => fake()->paragraph(3),
            'subtitle' => fake()->sentence(10),
            'button_link' => fake()->url(),
            'status' => fake()->boolean(),
        ];
    }
}
