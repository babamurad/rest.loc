<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\SliderFactory;
use Database\Seeders\WhyChooseUsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       User::factory()->create([
           'name' => 'Test User',
           'email' => 'test@example.com',
       ]);

//        $this->call(UserSeeder::class);
       Slider::factory(3)->create();
       $this->call(class: WhyChooseUsSeeder::class);
       $this->call(WcuSectionSeeder ::class);
       $this->call(CategorySeeder::class);
       Product::factory(20)->create();
       Coupon::factory(3)->create();
    }
}
