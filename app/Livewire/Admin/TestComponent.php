<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductSize;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TestComponent extends Component
{
    public $products;
    public $product;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $this->products = Product::with('sizes', 'options')->get();
        return view('livewire.admin.test-component');
    }

    public function mount()
    {
        $this->product = Product::with('sizes', 'options')->first();
    }

    public function getProduct($id)
    {
//        $this->product = Product::with('sizes', 'options')->findOrFail($id);
        $this->dispatch('loading-product');
        $this->isLoading = true;
        $this->product = Product::with('sizes', 'options')->findOrFail($id);
        $this->isLoading = false;
        $this->dispatch('product-loaded');
    }

    public function getTotal($sum)
    {
//        dd($sum);
        $this->dispatch('close-modal');
    }

}
