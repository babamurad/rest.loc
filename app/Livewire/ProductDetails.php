<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product;
    public $imagePaths;

    public function render()
    {
        $relatedProducts = Product::where('category_id', $this->product->category_id)->where('id', '!=', $this->product->id)->with('category')->take(8)->latest()->get();
        return view('livewire.product-details', compact('relatedProducts'));
    }

    public function mount($slug)
    {
        $this->product = Product::with('sizes', 'options')->where('slug', $slug)->firstOrFail();
        $imagesString = $this->product->images; // Или другой способ получить значение
        $this->imagePaths = explode(',', $imagesString);
//        dd($this->imagePaths);
        if (!$this->product) {
            abort(404);
        }
    }
}
