<?php

namespace App\Livewire\Admin\DailyOffer;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Daily Offer')]
class DailyOfferCreateComponent extends Component
{
    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $products = Product::all();
        return view('livewire.admin.daily-offer.daily-offer-create-component', compact('products'));
    }


}
