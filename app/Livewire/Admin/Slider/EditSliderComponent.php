<?php

namespace App\Livewire\Admin\Slider;

use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditSliderComponent extends Component
{
    use WithFileUploads;
    public $image;
    public $newimage;
    public $idEdit;
    public $title;
    public $subtitle;
    public $description;
    public $link;
    public $offer;
    public $sort_order;
    public $status;

    protected $rules = [
        'image' =>'required|image|mimes:jpeg,png,jpg|max:2048',
        'title' =>'required|string|max:255',
        'description' =>'required|string',
        'link' =>'required|url',
        'subtitle' =>'required|string|max:255',
        'offer' =>'required|string|max:255',
        'sort_order' =>'required|integer|min:0',
    ];

    public function updateSlider()
    {
        $slider = Slider::findOrFail($this->idEdit);
        $slider->id = $this->idEdit;
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->description = $this->description;
        $slider->button_link = $this->link;
        $slider->offer = $this->offer;
        $slider->sort_order = $this->sort_order;
        $slider->status = $this->status;
        if ($this->newimage){
            if (file_exists('uploads/sliders/'.$this->image)){
                unlink('uploads/sliders/' . $this->image);
            }
            $imageName ='uploads/sliders/' . Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->newimage->storeAs($imageName);
            $slider->image = $imageName;
        }
        $slider->update();
        toastr()->success('Slider updated successfully');
        $this->redirect(route('admin.slider'), navigate:true);
    }

    public function cancel()
    {
        $this->redirect(route('admin.slider'), navigate:true);
    }

    public function mount($id)
    {
        $slider = Slider::findOrFail($id);
        $this->idEdit = $slider->id;
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->description = $slider->description;
        $this->link = $slider->button_link;
        $this->offer = $slider->offer;
        $this->sort_order = $slider->sort_order;
        $this->status = $slider->status;
        $this->image = $slider->image;
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.slider.edit-slider-component');
    }
}
