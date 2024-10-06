<?php

namespace App\Livewire\Partials;

use App\Models\WcuSection;
use Livewire\Component;

class DailyOfferComponent extends Component
{
    public function render()
    {
        $titles = WcuSection::where('id', 2)->first();
        return view('livewire.partials.daily-offer-component', compact('titles'));
    }
}
