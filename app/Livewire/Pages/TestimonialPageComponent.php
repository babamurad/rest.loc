<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\WithPagination;

class TestimonialPageComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $testimonials = Testimonial::where(['status' => 1, 'show_at_home' => 1])->paginate(9);
        return view('livewire.pages.testimonial-page-component', ['testimonials' => $testimonials]);
    }
}
