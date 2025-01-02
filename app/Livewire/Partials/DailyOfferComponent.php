<?php

namespace App\Livewire\Partials;

use App\Models\DailyOffer;
use App\Models\Product;
use App\Models\WhyChooseUs;
use Livewire\Component;

class DailyOfferComponent extends Component
{
    public $product;
    public $closeModal = false;

    public function test()
    {
        dd('test');
    }

    public function productDaily($id)
    {
        dd($id);
        $this->isLoading = true;
        $this->product = Product::with('sizes', 'options')->findOrFail($id);
        $this->isLoading = false;
        $this->closeModal = false;
        $this->dispatch('product-loaded');
        $this->dispatch('show-modal-daily');
    }



    public function render()
    {
        $titles = WhyChooseUs::where('id', 2)->first();
        $dailyOffers = DailyOffer::where('status', 1)->with('product')->get();
        //dd($dailyOffers);
        return view('livewire.partials.daily-offer-component', compact('titles', 'dailyOffers'));
    }
}
