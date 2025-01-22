<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Testimonial;
use Carbon\Carbon;

class TestimonialCreate extends Component
{
    use WithFileUploads;
    public $image = '';
    public $name;
    public $title;
    public $review;
    public $rating;
    public $show_at_home;
    public $status;
    public $sort_order;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.testimonial.testimonial-create');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|numeric',
            'show_at_home' => 'required',
            'status' => 'required',
            'sort_order' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = 'uploads/testimonials/' . Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs($imageName);
        $testimonial = new Testimonial();
        $testimonial->image = $imageName;
        $testimonial->name = $this->name;
        $testimonial->title = $this->title;
        $testimonial->review = $this->review;
        $testimonial->rating = $this->rating;
        $testimonial->show_at_home = $this->show_at_home;
        $testimonial->status = $this->status;
        $testimonial->sort_order = $this->sort_order;
        $testimonial->save();
        $this->reset();
        session()->flash('message', 'Testimonial created successfully.');
        $this->redirect(route('admin.testimonial'), navigate:true);
    }

    public function cancel()
    {
        $this->reset();
        $this->redirect(route('admin.testimonial'), navigate:true);
    }
}
