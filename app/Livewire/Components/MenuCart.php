<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Cart;
use Livewire\Attributes\On;

class MenuCart extends Component
{
    #[On('Product_added_to_cart')]
    public function render()
    {
        $cartProducts = Cart::content();
        //Cart::destroy();
        //dd($cartProducts);
        return view('livewire.components.menu-cart', compact('cartProducts'));
    }

    public function deleteCartItem($rowId)
    {
        Cart::remove($rowId);
        toastr()->error(__('Product has been deleted from cart!'));
    }
}
