<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Delete category
     *
     * @param int $id
     * @return void
     */
    public function deleteCategory(int $id): void
    {
        $item = Category::findOrFail($id);
        $item->delete();
    }
}