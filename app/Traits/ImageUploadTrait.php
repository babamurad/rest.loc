<?php

namespace App\Traits;

use Carbon\Carbon;

trait ImageUploadTrait
{
    /**
     * Загрузка изображения
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return string путь к сохранённому изображению
     */
    public function uploadImage($file, $directory = 'images')
    {
        dd($file);
        // Создаём уникальное имя файла
        $imageName ='uploads/' . $directory . '/' . Carbon::now()->timestamp.'.'.$file->getClientOriginalName();
        //Сохраняем файл
        $file->storeAs($imageName);

        return $imageName; // Возвращаем путь к файлу
    }

    /**
     * Удаление изображения
     *
     * @param string|null $filePath
     * @return void
     */
    public function deleteImage($filePath, $directory = 'images')
    {
        if ($filePath && file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
