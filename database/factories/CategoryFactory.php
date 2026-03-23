<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Фабрика для создания фейковых категорий.
 */
class CategoryFactory extends Factory
{
    /**
     * Модель, соответствующая фабрике.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Определяет состояние модели по умолчанию.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->words(2, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            // Убираем поле image, так как его нет в базе данных
            'order' => $this->faker->numberBetween(1, 100),
            'status' => 1,
        ];
    }
}


