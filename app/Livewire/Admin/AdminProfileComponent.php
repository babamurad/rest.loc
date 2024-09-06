<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AdminProfileComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-profile-component')
            ->layout('livewire.admin.layouts.admin-app');
    }
}
