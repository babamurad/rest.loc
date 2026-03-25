<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdvancedFoodSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('product_galleries')->truncate();
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        // ========================
        // КАТЕГОРИИ + ключевые слова для фото
        // ========================
        $categories = [
            'burgers' => ['Бургеры', 'burger'],
            'pizza' => ['Пицца', 'pizza'],
            'soups' => ['Супы', 'soup'],
            'grill' => ['Мангал', 'grill meat'],
            'dessert' => ['Десерт', 'dessert cake'],
        ];

        foreach ($categories as $slug => $data) {
            DB::table('categories')->insert([
                'name' => $data[0],
                'slug' => $slug,
                'status' => 1,
                'show_at_home' => 1,
                'parent_id' => null,
                'order' => rand(1, 10),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $categoryIds = DB::table('categories')->pluck('id', 'slug');

        // ========================
        // ТОВАРЫ
        // ========================
        $menu = [

            'burgers' => [
                ['Классический бургер', 'Сочная говядина и сыр'],
                ['Чизбургер', 'Двойной сыр и котлета'],
                ['BBQ бургер', 'Соус барбекю и бекон'],
                ['Куриный бургер', 'Легкий и сочный'],
            ],

            'pizza' => [
                ['Маргарита', 'Классика Италии'],
                ['Пепперони', 'Пикантная колбаса'],
                ['4 сыра', 'Сырный микс'],
                ['Курица грибы', 'Нежный вкус'],
            ],

            'soups' => [
                ['Куриный суп', 'Легкий бульон'],
                ['Лагман', 'Сытный суп'],
                ['Борщ', 'Традиционный'],
                ['Чечевичный', 'Полезный суп'],
            ],

            'grill' => [
                ['Шашлык говяжий', 'На углях'],
                ['Куриный шашлык', 'Сочный'],
                ['Люля-кебаб', 'Ароматный'],
                ['Крылышки', 'Острые'],
            ],

            'dessert' => [
                ['Чизкейк', 'Сливочный'],
                ['Шоколадный торт', 'Насыщенный'],
                ['Мороженое', 'Освежающее'],
                ['Медовик', 'Домашний'],
            ],
        ];

        foreach ($menu as $categorySlug => $items) {

            $keyword = $categories[$categorySlug][1];

            foreach ($items as $index => $item) {

                $name = $item[0];
                $desc = $item[1];
                $slug = Str::slug($name);

                // 🔥 КРАСИВЫЕ РЕАЛЬНЫЕ КАРТИНКИ
                $image = "https://source.unsplash.com/600x400/?" . urlencode($keyword . ' ' . $name);

                $productId = DB::table('products')->insertGetId([
                    'name' => $name,
                    'slug' => $slug . '-' . rand(100,999),
                    'thumb_image' => $image,
                    'images' => null,
                    'price' => rand(20, 100),
                    'offer_price' => rand(0, 1) ? rand(15, 80) : 0,
                    'quantity' => rand(10, 200),
                    'short_description' => $desc,
                    'long_description' => $desc . ' — приготовлено из свежих ингредиентов.',
                    'sku' => strtoupper(substr($slug, 0, 3)) . rand(1000, 9999),
                    'status' => 1,
                    'is_featured' => rand(0, 1),
                    'show_at_home' => 1,
                    'seo_title' => $name,
                    'seo_description' => $desc,
                    'category_id' => $categoryIds[$categorySlug],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // ========================
                // ГАЛЕРЕЯ (3 фото на товар)
                // ========================
                for ($i = 1; $i <= 3; $i++) {
                    DB::table('product_galleries')->insert([
                        'product_id' => $productId,
                        'image' => "https://source.unsplash.com/600x400/?" . urlencode($keyword . ' food ' . $i),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
}