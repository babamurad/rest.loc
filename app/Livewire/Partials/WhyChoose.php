<?php

namespace App\Livewire\Partials;

use App\Models\WhyChooseUs;
use Livewire\Component;

class WhyChoose extends Component
{
    public function render()
    {
        $wcu1 = WhyChooseUs::where('key', '1')->first();
        return view('livewire.partials.why-choose', compact('wcu1'));
    }
}
