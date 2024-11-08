<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductSize;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TestComponent extends Component
{
    public $showModal = false;
    public $products;
    public $product;
    public $sizePrice, $optionPrice;
    public $sizeId;
    public $price = 0;
    public $sumTotal = 0;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        //dd($this->isOpen);
        $this->products = Product::with('sizes', 'options')->get();
        return view('livewire.admin.test-component');
    }

    public function mount()
    {
        $this->product = Product::with('sizes', 'options')->first();
    }

    public function calcTotal()
    {
        $this->sumTotal = (float) $this->price + (float) $this->sizePrice ;
    }

    public function selectSize($sizePrice)
    {
        $this->sizePrice = $sizePrice;
    }

    public function updatedSizePrice()
    {
        $this->calcTotal();
    }

    public function getProduct($id)
    {
        $this->product = Product::with('sizes', 'options')->findOrFail($id);
    }

    public function getTotal($sum)
    {
        dd($sum);
    }

}
