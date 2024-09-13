<?php

namespace Database\Seeders;

use App\Models\WhyChooseUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhyChooseUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WhyChooseUs::insert(
        [
            'key' => '1',
            'top_title' => 'Why Choose Us',
            'title' => 'Why Choose Us',
            'sub_title' => 'Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials.',
        ],
        );
    }
}
