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
    public $product;
    public $isLoading = false;

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
        $this->product = Product::with('sizes', 'options')->first();
    }

    public function getProduct($id)
    {
        $this->dispatch('loading-product');
        $this->isLoading = true;
        $this->product = Product::with('sizes', 'options')->findOrFail($id);
        $this->isLoading = false;
        $this->dispatch('product-loaded');
        $this->dispatch('show-modal');
    }

    public function getTotal()
    {
        $this->dispatch('close-modal');
    }
}
