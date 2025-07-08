<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\WcuSection;
use App\Services\CategoryService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Компонент для отображения списка категорий в административной панели.
 */
class CategoryIndexComponent extends Component
{
    use WithPagination;

    /**
     * ID категории для удаления.
     *
     * @var int|null
     */
    public $delId;

    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * Внедрение CategoryService.
     *
     * @param CategoryService $categoryService
     * @return void
     */
    public function boot(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Сброс номера страницы при поиске.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Отображение компонента.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $categories = Category::with('products')->orderBy('order', 'asc')->paginate(10);
        return view('livewire.admin.category.category-index-component', compact('categories'));
    }

    /**
     * Удаление категории.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        try {
            // Удаляем категорию с помощью CategoryService
            $this->categoryService->deleteCategory($this->delId);
            $this->dispatch('closeModal');
            toastr()->success('Категория удалена!');
        } catch (\Exception $e) {
            // Логируем ошибку
            \Log::error('Ошибка при удалении категории: ' . $e->getMessage());
            toastr()->error('Ошибка при удалении категории!');
        }
        return redirect()->route('admin.category.index');
    }

    /**
     * Установка ID категории для удаления.
     *
     * @param int $id
     * @return void
     */
    public function deleteId($id)
    {
        $this->delId = $id;
    }
}
