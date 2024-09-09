<?php

namespace App\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SliderComponent extends Component
{
    public $slide_id;

    public function deleteSlide($id)
    {
        dd('deleteSlide-' . $id);
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $sliders = Slider::all();
        return view('livewire.admin.slider.slider-component', compact('sliders'));
    }
}
