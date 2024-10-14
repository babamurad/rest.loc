<?php

namespace App\Livewire\Partials;

use App\Models\WhyChooseUs;
use Livewire\Component;

class DailyOfferComponent extends Component
{
    public function render()
    {
        $titles = WhyChooseUs::where('id', 2)->first();
        return view('livewire.partials.daily-offer-component', compact('titles'));
    }
}
