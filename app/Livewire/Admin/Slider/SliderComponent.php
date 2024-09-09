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
        $this->slide_id = $id;
    }

    public function confirmDeleteSlide()
    {
        Slider::destroy($this->slide_id);
        $this->slide_id = null;
        flash()->error('Slider deleted successfully!');
    }

    public function cancel()
    {
        $this->slide_id = null;
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $sliders = Slider::all();
        return view('livewire.admin.slider.slider-component', compact('sliders'));
    }
}
