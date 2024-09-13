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
//        dd('deleteSlide-' . $id);
        $this->slide_id = $id;
    }

    public function destroy()
    {
        $slider = Slider::findOrFail($this->slide_id);

        $slider->delete();
        toastr()->error('Slider has been deleted.');
//        $this->dispatch('destroySlider');
    }

    #[Layout('livewire.admin.layouts.admin-app')]
//    #[On('destroySlider')]
    public function render()
    {
        $sliders = Slider::all();
        return view('livewire.admin.slider.slider-component', compact('sliders'));
    }
}
