<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Chef;
use Livewire\WithPagination;

class ChefPageComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $chefs = Chef::where(['status' => 1, 'show_at_home' => 1])->paginate(8);

        return view('livewire.pages.chef-page-component', compact('chefs'));
    }    
}
