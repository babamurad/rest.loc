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
    /**
     * @var string
     */
    public $search = '';
    /**
     * @var string
     */
    public $sortBy = 'created_at';
    /**
     * @var string
     */
    public $sortDirection = 'DESC';
    /**
     * @var string
     */
    public $sortIcon = '<i class="fas fa-sort mr-1 text-muted"></i>';
    /**
     * @var int
     */
    public $perPage = 8;
    /**
     * @var int|null
     */
    public $delId;
    /**
     * @var string
     */
    public $selectedCat = '';
    /**
     * @var string|null
     */
    public $err;

    /**
     * @var ProductService
     */
    private \App\Services\ProductService $productService;

    /**
    public function __construct(private \App\Services\ProductService $productService)
    {
    }

    /**
     * Устанавливает ID продукта для удаления.
     *
     * @param int $id
     * @return void
     */
    public function deleteId($id)
    {
        $this->delId = $id;
    }

    /**
     * Удаляет продукт.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        try {
            $this->productService->deleteProduct($this->delId);
            $this->dispatch('closeModal');
            toastr()->success('Продукт удален!');
            return redirect()->route('admin.product.index');
        } catch (\Exception $e) {
            \Log::error('Ошибка при удалении продукта: ' . $e->getMessage());
            $this->err = $e->getMessage();
            toastr()->error('Что-то пошло не так! ' . $e->getMessage());
        }

    }

    /**
     * Изменяет тип сортировки.
     *
     * @param string $fieldName
     * @return void
     */
    public function sortType($fieldName)
    {
        $this->sortBy = $fieldName;
        $this->sortDirection = $this->sortDirection === 'asc'? 'desc' : 'asc';
        $this->sortIcon = $this->sortDirection === 'asc'? '<i class="fas fa-sort-up mr-1"></i>':'<i class="fas fa-sort-down mr-1"></i>';
    }

    /**
     * Обновляет выбранное количество записей на странице.
     *
     * @param int $value
     * @return void
     */
    public function updatedPerPage($value)
    {
        session(['perPage' => $value]);
    }

    /**
     * Обновляет выбранную категорию.
     *
     * @param string $value
     * @return void
     */
    public function updatedSelectedCat($value)
    {
        // Сохраняем выбранную категорию в сессию
        session(['selectedCat' => $value]);
    }

    /**
     * Заглушка для отображения во время загрузки.
     *
     * @return string
     */
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

    /**

    /**
     * Отображение компонента.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
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
