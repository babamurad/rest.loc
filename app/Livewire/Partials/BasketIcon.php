<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Livewire\Attributes\On;

class BasketIcon extends Component
{
    #[On('Product_added_to_cart')]
    public function render()
    {
        return view('livewire.partials.basket-icon');
    }
}
