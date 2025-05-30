<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Lazy;
use Livewire\WithPagination;
use App\Traits\ImageUploadTrait;

#[Title('Products List')]
//#[Lazy]
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

    public function placeholder()
    {
        return <<<'HTML'
            <section class="section">
                <div class="section-header">
                    <h4>{{ __('All Products') }}</h4>
                </div>
                <div class="card card-primary">
                    <h4>Loading...</h4>
                </div>
            </section>
        HTML;

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

// Применяем поиск по названию продукта
        if (!empty($this->search) && strlen($this->search) >= 3) {
            $products_query->where('name', 'LIKE', '%' . $this->search . '%');
        }

// Применяем фильтр по категории
        if (!empty($this->selectedCat)) {
            $products_query->where('category_id', $this->selectedCat);
        }

// Присоединяем таблицу категорий и выбираем поля
        $products_query //->leftJoin('categories', 'products.category_id', '=', 'categories.id')
             //->select('products.*', 'categories.name as category_name')
            ->with('category');
            //->groupBy('products.id'); // Предотвращаем дублирование записей при пагинации

// Выполняем запрос с сортировкой и пагинацией
        $products = $products_query
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.product.product-index-component', compact('products', 'categories'));
    }

}
