<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;

class MenuComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 12;
    public $search = null;
    public $categoryId = null;
    public $categoryName = null;
    public $isOpened = false;

    public function render()
    {
        $categories = Category::with('products')->where('status', 1)->get();        
        
        $products_query = Product::query();
        if ($this->categoryId) {
            $products_query->where('category_id', $this->categoryId);
        }
        if ($this->search) {
            $products_query->where('name', 'like', '%' . $this->search . '%');
        }
        $products = $products_query
        ->with('category', 'sizes', 'options')
        ->paginate($this->perPage);

        return view('livewire.pages.menu-component', compact('categories', 'products'));
    }

    public function updatedSearch()
    {
        //$this->resetPage();
    }

    public function updatedCategoryId()
    {
        //dd($this->categoryId);
    }

    public function selectCategory($id) 
    {
        $this->resetPage();
        $this->categoryId = $id;
        $this->categoryName = ucfirst(Category::find($id)->name);
        $this->isOpened = false;
    }

    public function resetCategory()
    {
        $this->categoryId = null;
        $this->categoryName = null;
    }

}
