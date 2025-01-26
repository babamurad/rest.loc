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
    public $product;
    public $isLoading = false;
    public $closeModal = false;
    public $totalSummary = 0;
    public $showModal = false;
    public $isModalOpen = false;

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
    
    public function mount($id = null)
    {        
        if ($id) {
            $this->categoryId = $id;
            $this->categoryName = ucfirst(Category::find($id)->name);
        }
        $this->product = Product::with('sizes', 'options')->first();
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

    // #[On('show-product-details')]
    public function getProduct($id)
    {        
        $this->isLoading = true;
        $this->product = Product::with('sizes', 'options')->findOrFail($id);
        $this->isLoading = false; 
        $this->showModal = true;
        //dd($this->showModal);  
    }

}
