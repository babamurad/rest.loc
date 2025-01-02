<?php

namespace App\Livewire\Admin\DailyOffer;

use App\Models\DailyOffer;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Daily Offer')]
class DailyOfferCreateComponent extends Component
{
    public $products;
    public $selectedProducts = []; // ID выбранных товаров
    public $search = ''; // Поисковый запрос
    public $filteredProducts = []; // Отфильтрованный список продуктов
    public $product;
    public $name = '';
    public $productId = null;
    public $status = 1; // Статус дня (active, inactive)

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.daily-offer.daily-offer-create-component');
    }

    public function updatedSearch()
    {
        // Фильтрация продуктов по имени
        $this->filteredProducts = Product::where('name', 'like', '%'.$this->search.'%')->where('show_at_home', 1)->get();
        //dd($this->filteredProducts); // Вывод отфильтрованных продуктов для проверки
    }

    public function addProduct($productId)
    {
        $this->productId = $productId;
        $this->product = Product::find($productId);
        $this->name = $this->product->name;
        $this->search = '';
        $this->filteredProducts = [];
    }

    public function removeProduct($productId)
    {
        $this->selectedProducts = array_filter($this->selectedProducts, function ($id) use ($productId) {
            return $id != $productId;
        });
    }

    public function create()
    {
        $dailyOffer = new DailyOffer();
        $dailyOffer->product_id = $this->productId;
        $dailyOffer->status = $this->status;
        $dailyOffer->save();
        $this->reset();
        $this->redirect(route('admin.daily'), navigate: true);
        toastr()->flash('success', 'Daily offer added');
    }

    public function cancel()
    {
        $this->reset();
        toastr()->flash('success', 'Cancelled');
        $this->redirect(route('admin.daily'), navigate: true);
    }

}

