<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\ImageUploadTrait;

class ProductIndexComponent extends Component
{
    use WithPagination;
    use ImageUploadTrait;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';
    public $sortIcon = '<i class="fas fa-sort mr-1 text-muted"></i>';
    public $perPage = 8;
    public $delId;
    public $selectedCat = '';
    public $err;

    public function deleteId($id)
    {
        $this->delId = $id;
    }

    public function destroy()
    {
        try {
            $product = Product::findOrFail($this->delId);
            $filePath = $product->thumb_image;
            $directory = 'products'; // Укажите вашу директорию хранения изображений
            $this->deleteImage($filePath, $directory);
            /*if ($filePath && file_exists($filePath)) {
                unlink($filePath);
            }*/
            $product->delete();
            $this->dispatch('closeModal');
            toastr()->error('Deleted!');
            return redirect()->route('admin.product.index');
        } catch (\Exception $e) {
            $this->err = $e->getMessage();
            toastr()->error('Something went wrong! ' . $e);
        }

    }

    public function sortType($fieldName)
    {
        $this->sortBy = $fieldName;
        $this->sortDirection = $this->sortDirection === 'asc'? 'desc' : 'asc';
        $this->sortIcon = $this->sortDirection === 'asc'? '<i class="fas fa-sort-up mr-1"></i>':'<i class="fas fa-sort-down mr-1"></i>';
    }

    // Метод для обновления выбранного количества записей
    public function updatedPerPage($value)
    {
        session(['perPage' => $value]);
    }

    // Метод для обновления выбранной категории
    public function updatedSelectedCat($value)
    {
        // Сохраняем выбранную категорию в сессию
        session(['selectedCat' => $value]);
    }


    public function mount()
    {
        // Загружаем сохранённое количество отображения записей из сессии, если она существует
        $this->perPage = session('perPage', $this->perPage);
        // Загружаем сохранённую категорию из сессии, если она существует
        $this->selectedCat = session('selectedCat', $this->selectedCat);
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $categories = Category::all();
        $products_query = Product::query();

// Применяем поиск по названию продукта, если введено не менее 3 символов
        if (!empty($this->search) && strlen($this->search) >= 3) {
            $products_query->where('name', 'LIKE', '%' . $this->search . '%');
        }

// Применяем фильтр по категории, если выбрана категория
        if (!empty($this->selectedCat)) {
            $products_query->where('category_id', $this->selectedCat);
        }

// Присоединяем таблицу категорий, чтобы сортировать по имени категории
        $products_query->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*') // Выбираем поля из таблицы products
            ->with('category'); // Загружаем связанные категории

// Выполняем запрос с сортировкой и пагинацией
        $products = $products_query
//            ->orderBy('categories.name', 'asc') // Сортировка по имени категории
            ->orderBy($this->sortBy, $this->sortDirection) // Ваша дополнительная сортировка
            ->paginate($this->perPage); // Пагинация

        return view('livewire.admin.product.product-index-component', compact('products', 'categories'));
    }
}
