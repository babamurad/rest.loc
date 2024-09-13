<?php

namespace App\Livewire\Admin\WhyChooseUs;

use App\Models\WhyChooseUs;
use Livewire\Attributes\Layout;
use Livewire\Component;

class WhyChooseUsComponent extends Component
{


    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $chooses = WhyChooseUs::all();
        return view('livewire.admin.why-choose-us.why-choose-us-component', compact('chooses'));
    }
}
