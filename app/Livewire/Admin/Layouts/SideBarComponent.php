<?php

namespace App\Livewire\Admin\Layouts;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('livewire.admin.layouts.admin-app')]
class SideBarComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.layouts.side-bar-component');
    }
}
