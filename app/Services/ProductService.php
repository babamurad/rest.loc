<?php

namespace App\Services;

use App\Models\Product;
use App\Traits\ImageUploadTrait;

class ProductService
{
    use ImageUploadTrait;

    /**
     * Удаляет продукт.
     *
     * @param int $id
     * @return void
     */
    public function deleteProduct(int $id): void
    {
        $product = Product::findOrFail($id);
        $filePath = $product->thumb_image;
        $directory = 'products'; // Укажите вашу директорию хранения изображений
        $this->deleteImage($filePath, $directory);
        $product->delete();
    }
}