<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use App\Models\Chef;

class ChefComponent extends Component
{
    public function render()
    {
        $chefs = Chef::where(['status' => 1, 'show_at_home' => 1])->get();
        return view('livewire.partials.chef-component', compact('chefs'));
    }
}
