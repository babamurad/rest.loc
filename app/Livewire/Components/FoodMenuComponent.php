<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class FoodMenuComponent extends Component
{
    public $prod;
    public $selectedId;
    public $name;
    public $price;
    public $offer_price;
    public $showModal = false;

    public function render()
    {
        $categories = Category::where('status', 1)->get();
        $products = Product::with('category')->where('show_at_home', 1)->take(12)->get();//where('status', 1)->
//        $product = Product::find(41);
//        dd($product->category->name);
//        ->where('status', 1)
        return view('livewire.components.food-menu-component', compact('categories', 'products'));
    }

    public function mount()
    {
        $product = Product::first();
    }

    public function openModal($id)
    {
        $this->selectedId = $id;
        $this->prod = Product::with('sizes', 'options')->findOrFail($this->selectedId);
//        $this->product = Product::find($id)->with('sizes', 'options');
//        dd($this->product);
//        dd($id);
        $this->name = $this->prod->name;
        $this->price = $this->prod->price;
        $this->offer_price = $this->prod->offer_price;
        $this->showModal = true;
//        dd($this->product->name);
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
