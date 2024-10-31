<?php

namespace App\Livewire\Components;

use App\Models\Product;
use Livewire\Component;

class ProductModal extends Component
{
    public $product;

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
        dd($this->product);
    }

    public function render()
    {
        return view('livewire.components.product-modal');
    }
}
