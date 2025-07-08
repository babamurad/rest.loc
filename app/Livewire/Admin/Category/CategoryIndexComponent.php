<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\WcuSection;
use App\Services\CategoryService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndexComponent extends Component
{
    use WithPagination;

    public $delId;

    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * Inject CategoryService
     *
     * @param CategoryService $categoryService
     * @return void
     */
    public function boot(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Reset page number when searching
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }
    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $categories = Category::with('products')->orderBy('order', 'asc')->paginate(10);
        return view('livewire.admin.category.category-index-component', compact('categories'));
    }

    /**
     * Delete category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        try {
            $this->categoryService->deleteCategory($this->delId);
            $this->dispatch('closeModal');
            toastr()->error('Deleted!');
        } catch (\Exception $e) {
            toastr()->error('Error deleting category!');
        }
        return redirect()->route('admin.category.index');
    }

    public function deleteId($id)
    {
        $this->delId = $id;
    }
}
