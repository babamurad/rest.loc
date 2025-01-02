<?php

namespace App\Livewire\Partials;

use App\Models\Product;
use Livewire\Component;

class CartPopupComponent extends Component
{
    public $product;

    public function render()
    {
        return view('livewire.partials.cart-popup-component');
    }

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
    }
}
