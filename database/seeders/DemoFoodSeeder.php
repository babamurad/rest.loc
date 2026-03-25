<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DemoFoodSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        // ========================
        // КАТЕГОРИИ
        // ========================
        $categories = [
            ['name' => 'Бургеры', 'slug' => 'burgers'],
            ['name' => 'Пицца', 'slug' => 'pizza'],
            ['name' => 'Супы', 'slug' => 'soups'],
            ['name' => 'Мангал', 'slug' => 'grill'],
            ['name' => 'Десерт', 'slug' => 'dessert'],
        ];

        foreach ($categories as $index => $cat) {
            DB::table('categories')->insert([
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'status' => 1,
                'show_at_home' => 1,
                'parent_id' => null,
                'order' => $index + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // получаем id категорий
        $categoryIds = DB::table('categories')->pluck('id', 'slug');

        // ========================
        // ТОВАРЫ
        // ========================
        $products = [

            // Бургеры
            ['Классический бургер', 'Говядина, сыр, овощи', 45, 'burgers'],
            ['Чизбургер двойной', 'Двойная котлета и сыр', 60, 'burgers'],
            ['Куриный бургер', 'Курица и соус', 40, 'burgers'],
            ['Бургер BBQ', 'BBQ соус и бекон', 55, 'burgers'],

            // Пицца
            ['Маргарита', 'Томат, сыр', 70, 'pizza'],
            ['Пепперони', 'Колбаса и сыр', 85, 'pizza'],
            ['4 сыра', 'Четыре сыра', 95, 'pizza'],
            ['Курица с грибами', 'Курица и грибы', 90, 'pizza'],

            // Супы
            ['Куриный суп', 'Куриный бульон', 25, 'soups'],
            ['Лагман', 'Мясо и лапша', 35, 'soups'],
            ['Борщ', 'Свекла и мясо', 30, 'soups'],
            ['Чечевичный суп', 'Чечевица', 28, 'soups'],

            // Мангал
            ['Шашлык говяжий', 'Говядина', 80, 'grill'],
            ['Шашлык куриный', 'Курица', 65, 'grill'],
            ['Люля-кебаб', 'Фарш и специи', 70, 'grill'],
            ['Крылышки', 'Куриные крылья', 60, 'grill'],

            // Десерт
            ['Чизкейк', 'Сливочный десерт', 35, 'dessert'],
            ['Шоколадный торт', 'Шоколад', 30, 'dessert'],
            ['Мороженое', 'Разные вкусы', 20, 'dessert'],
            ['Медовик', 'Медовый торт', 32, 'dessert'],
        ];

        $i = 1;

        foreach ($products as $item) {
            [$name, $desc, $price, $categorySlug] = $item;

            $slug = Str::slug($name);

            // 🔥 Генерация картинки (уникальная)
            $image = "https://picsum.photos/seed/food{$i}/400/300";

            DB::table('products')->insert([
                'name' => $name,
                'slug' => $slug,
                'thumb_image' => $image,
                'images' => null,
                'price' => $price,
                'offer_price' => 0,
                'quantity' => rand(50, 150),
                'short_description' => $desc,
                'long_description' => $desc . ' — вкусное блюдо для вашего меню.',
                'sku' => strtoupper(substr($slug, 0, 3)) . rand(100, 999),
                'status' => 1,
                'is_featured' => rand(0, 1),
                'show_at_home' => 1,
                'seo_title' => $name,
                'seo_description' => $desc,
                'category_id' => $categoryIds[$categorySlug],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $i++;
        }
    }
}