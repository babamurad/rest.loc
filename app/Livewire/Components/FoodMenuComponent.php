<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class FoodMenuComponent extends Component
{
    public $product;
    public $selectedId;
    public $showModal = false;

    public function render()
    {
        $categories = Category::where('status', 1)->get();
        $products = Product::with('category')->get();//where('status', 1)->
//        $product = Product::find(41);
//        dd($product->category->name);
        return view('livewire.components.food-menu-component', compact('categories', 'products'));
    }

    public function openModal($id)
    {
        $this->selectedId = $id;
        $this->product = Product::find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedId = null;
    }
}
