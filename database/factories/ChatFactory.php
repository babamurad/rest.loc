<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    protected $model = Chat::class;

    public function definition()
    {
        return [
            'sender_id' => User::factory(),
            'receiver_id' => User::factory(),
            'message' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
} 