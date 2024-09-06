<?php

namespace App\Livewire\Admin\Layouts;

use Livewire\Component;

class SideBarComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.layouts.side-bar-component')
            ->layout('livewire.admin.layouts.admin-app');
    }
}
