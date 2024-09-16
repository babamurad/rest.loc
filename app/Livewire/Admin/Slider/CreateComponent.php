<?php

namespace App\Livewire\Admin\Slider;

use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateComponent extends Component
{
    use WithFileUploads;
    public $image = '';
    public $title;
    public $description;
    public $link;
    public $subtitle;
    public $offer;
    public $sort_order = 0;
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

    public function createSlider()
    {
        $this->validate();
        $slider = new Slider();
        $slider->title = $this->title;
        $slider->description = $this->description;
        $slider->button_link = $this->link;
        $slider->subtitle = $this->subtitle;
        $slider->offer = $this->offer;
        $slider->sort_order = $this->sort_order;
        $slider->status = $this->status;

        $imageName          = 'uploads/sliders/' . Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs($imageName);
        $slider->image       = $imageName;

        //$slider->image = $imageName;
        $slider->save();

       toastr()->success('Slider created successfully');

       $this->redirect(route('admin.slider'), navigate:true);
    }

    public function cancel()
    {
        $this->title = '';
        $this->description = '';
        $this->link = '';
        $this->subtitle = '';
        $this->offer = '';
        $this->sort_order = 0;
        $this->status = 1;
        $this->image = '';
        $this->reset(['image', 'description', 'link', 'subtitle', 'offer', 'sort_order','status'  ] );
        $this->redirect(route('admin.slider'), navigate:true);
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.slider.create-component');
    }
}
