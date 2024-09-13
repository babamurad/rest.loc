<?php

namespace App\Livewire\Admin\WhyChooseUs;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateComponent extends Component
{
    public $icon = 'fas fa-icons';


    public function createItem()
    {
        dd($this->icon);
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.why-choose-us.create-component');
    }
}
