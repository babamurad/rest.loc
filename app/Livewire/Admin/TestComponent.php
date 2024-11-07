<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TestComponent extends Component
{
    public $showModal = false;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        //dd($this->isOpen);
        $this->posts = Product::all();
        return view('livewire.admin.test-component');
    }

}
