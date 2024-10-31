<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class FoodMenuComponent extends Component
{
    public $product;
    public $selectedId;
    public $name;
    public $price;
    public $offer_price;

    public function render()
    {
        $categories = Category::where('status', 1)->get();
        $products = Product::with('category')->get();//where('status', 1)->
//        $product = Product::find(41);
//        dd($product->category->name);
        return view('livewire.components.food-menu-component', compact('categories', 'products'));
    }

    public function mount()
    {
        $product = Product::first();
    }

    public function openModal($id)
    {
        $this->selectedId = $id;
        $product = Product::find($id)->with('sizes', 'options');
        $this->name = $product->name;
        $this->price = $product->price;
        $this->offer_price = $product->offer_price;
        //dd($this->name);
        $this->dispatch('show-modal');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedId = null;
    }

    public function toggleModal()
    {
        //dd('mod');
        $this->showModal = !$this->showModal;
    }
}
