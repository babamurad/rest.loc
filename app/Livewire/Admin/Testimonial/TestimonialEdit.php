<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Testimonial;
use Carbon\Carbon;

class TestimonialEdit extends Component
{
    use WithFileUploads;
    public $editId;
    public $image;
    public $newimage = '';
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
        return view('livewire.admin.testimonial.testimonial-edit');
    }

    public function mount($id)
    {
        $testimonial = Testimonial::find($id);
        if ($testimonial) {
            $this->editId = $testimonial->id;
            $this->image = $testimonial->image;
            $this->name = $testimonial->name;
            $this->title = $testimonial->title;
            $this->review = $testimonial->review;
            $this->rating = $testimonial->rating;
            $this->show_at_home = $testimonial->show_at_home;
            $this->status = $testimonial->status;
            $this->sort_order = $testimonial->sort_order;
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|numeric',
            'show_at_home' => 'required',
            'status' => 'required',
            'sort_order' => 'required|numeric',
            // 'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $testimonial = Testimonial::find($this->editId);
        if ($testimonial) {
            if ($this->newimage) {
                $imageName = 'uploads/testimonials/' . Carbon::now()->timestamp . '.' . $this->newimage->extension();
                $this->image->storeAs($imageName);
                $testimonial->image = $imageName;
            }
            $testimonial->name = $this->name;
            $testimonial->title = $this->title;
            $testimonial->review = $this->review;
            $testimonial->rating = $this->rating;
            $testimonial->show_at_home = $this->show_at_home;
            $testimonial->status = $this->status;
            $testimonial->sort_order = $this->sort_order;
            $testimonial->update();
            session()->flash('message', 'Testimonial updated successfully.');
            $this->redirect(route('admin.testimonial'), navigate:true);
        }
    }

    public function cancel()
    {   
        $this->reset();
        $this->redirect(route('admin.testimonial'), navigate:true);
    }
}
