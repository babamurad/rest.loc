<?php

namespace App\Livewire\Components;

use App\Models\Slider;
use Livewire\Component;

class SliderComponent extends Component
{
    public function render()
    {
        $sliders = Slider::orderBy('sort_order')->status()->get();
        return view('livewire.components.slider-component', compact('sliders'));
    }
}
