<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SliderComponent extends Component
{

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.slider-component');
    }
}
