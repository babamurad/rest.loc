<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryArea>
 */
class DeliveryAreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area_name' => $this->faker->city(),
            'min_delivery_time' => '30',
            'max_delivery_time' => '60',
            'delivery_fee' => 10.00,
            'status' => 1,
        ];
    }
}
