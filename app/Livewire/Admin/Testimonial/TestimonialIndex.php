<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Testimonial;
use Livewire\Attributes\Layout;
use App\Models\WhyChooseUs;

class TestimonialIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $delId;

    public $title;
    public $top_title;
    public $sub_title;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $testimonials = Testimonial::paginate(10);
        return view('livewire.admin.testimonial.testimonial-index', compact('testimonials'));
    }

    public function mount()
    {
        $titles = WhyChooseUs::where('key', 4)->first();
        if ($titles) {
            $this->title = $titles->title;
            $this->top_title = $titles->top_title;
            $this->sub_title = $titles->sub_title;
        }
    }
}
