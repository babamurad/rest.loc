<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductSize;
use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Renderless;

class FoodMenuComponent extends Component
{
    public $prod = null;
    public $selectedId;
    public $name;
    public $price;
    public $offer_price;
    public $showModal = false;
    public $sizePrice;
    public $optionsPrice = [];
    public $totalPrice = 0;

    public function render()
    {
        //hren blyaty с этим компонентом, с отображенем модального окна и фудменю блять пиздец нахуй
        // Fetch categories and products
        $categories = Category::where('status', 1)->get();
        $products = Product::with('category')->where('show_at_home', 1)->take(12)->get();//where('status', 1)->
//        ->where('status', 1)
        $setting = Setting::where('key', 'currency_icon')->first();

        // Return the view with categories and products
        return view('livewire.components.food-menu-component', compact('categories', 'products', 'setting'));
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
//        dd($this->prod);
//        dd($this->prod->name);
        $this->name = $this->prod->name;
        $this->price = $this->prod->price;
        $this->offer_price = $this->prod->offer_price;
        $this->showModal = true;
//        dd($this->showModal);
        $this->dispatch('show-modal');
    }

    public function updatedSizePrice()
    {
        //dd($this->sizePrice);
        $this->calcTotal();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedId = null;
        $this->dispatch('close-modal');
    }

    public function getSizePrice($sizeId)
    {
        //dd(ProductSize::findOrFail($sizeId)->price);
        $this->sizePrice = ProductSize::findOrFail($sizeId)->price;
    }
    public function getOptionsPrice($optionId)
    {
        $option = ProductOption::findOrFail($optionId);
        $this->dispatch('optionPriceUpdated', $option->price);
    }

    //#[Renderless]
    public function calcTotal()
    {
        $this->totalPrice = $this->totalPrice + $this->sizePrice;
    }
}
