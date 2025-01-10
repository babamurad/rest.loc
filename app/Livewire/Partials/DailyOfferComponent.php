<?php

namespace App\Livewire\Partials;

use App\Models\DailyOffer;
use App\Models\Product;
use App\Models\WhyChooseUs;
use Livewire\Component;

class DailyOfferComponent extends Component
{
    public function productDaily($id)
    {
        $this->dispatch('show-product-details', $id);
    }

    public function render()
    {
        $titles = WhyChooseUs::where('id', 2)->first();
        $dailyOffers = DailyOffer::where('status', 1)->with('product')->get();
        // dd($dailyOffers->count());
        return view('livewire.partials.daily-offer-component', compact('titles', 'dailyOffers'));
    }
}
