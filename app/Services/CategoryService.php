<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Удаление категории.
     *
     * @param int $id ID категории для удаления.
     * @return void
     */
    public function deleteCategory(int $id): void
    {
        // Находим категорию по ID
        $item = Category::findOrFail($id);
        // Удаляем категорию
        $item->delete();
    }
}