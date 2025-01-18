<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Chef;

class ChefPageComponent extends Component
{
    public function render()
    {
        $chefs = Chef::where(['status' => 1, 'show_at_home' => 1])->get();
        return view('livewire.pages.chef-page-component', compact('chefs'));
    }
}
