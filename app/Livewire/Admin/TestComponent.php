<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductSize;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Cart;

class TestComponent extends Component
{
    public $products;
    public $product;
    public $qty;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
//        $this->products = Product::with('sizes', 'options')->get();
        $cartProducts = Cart::content();

        return view('livewire.admin.test-component', compact('cartProducts'));
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

    public function qtyInc($rowId)
    {
        dd($this->qty);
        Cart::update($rowId, 2); // Will update the quantity
    }

}
