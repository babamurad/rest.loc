<?php

namespace Database\Seeders;

use App\Models\WcuSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WcuSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WcuSection::insert([
                [
                    'icon' => 'fas fa-percent',
                    'title' => 'Discount Voucher',
                    'description' => 'Get up to 50% off your first purchase.',
                ],
                [
                    'icon' => 'fas fa-burger-soda',
                    'title' => 'Fresh Healthy Foods',
                    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, debitis expedita .',
                ],
                [
                    'icon' => 'far fa-hat-chef',
                    'title' => 'Fast Serve On Table',
                    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, debitis expedita .',
                ],
            ]
        );
    }
}
