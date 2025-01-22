<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;

class TestimonialComponent extends Component
{
    public function render()
    {
        $titles = WhyChooseUs::where('key', 4)->first();
        $testimonials = Testimonial::where(['status' => 1, 'show_at_home' => 1])->get();
        return view('livewire.partials.testimonial-component', ['testimonials' => $testimonials, 'titles' => $titles]);
    }
}
