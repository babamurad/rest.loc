<?php

namespace Database\Seeders;

use App\Models\Catagory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Catagory::insert([
            [
                'name' => 'burger',
                'slug' => 'burger',
                'status' => 1,
                'show_at_home' => 1,
                'order' => 0,
            ],
            [
                'name' => 'pizza',
                'slug' => 'pizza',
                'status' => 1,
                'show_at_home' => 1,
                'order' => 0,
            ],
            [
                'name' => 'chicken',
                'slug' => 'chicken',
                'status' => 1,
                'show_at_home' => 1,
                'order' => 0,
            ],
            [
                'name' => 'pasta',
                'slug' => 'pasta',
                'status' => 1,
                'show_at_home' => 1,
                'order' => 0,
            ],
            [
                'name' => 'dresserts',
                'slug' => 'dresserts',
                'status' => 1,
                'show_at_home' => 1,
                'order' => 0,
            ]
        ]);
    }
}
