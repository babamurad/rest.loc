<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use Livewire\Attributes\Layout;


class TestimonialCreate extends Component
{
    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.testimonial.testimonial-create');
    }
}
