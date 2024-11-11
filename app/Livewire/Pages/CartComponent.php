<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Cart;
use Livewire\Attributes\On;

class CartComponent extends Component
{
    public $productTotal;

    #[On('Product_added_to_cart')]
    #[On('Product_deleted_from_cart')]
    public function render()
    {
        $cartProducts = Cart::content();
//        dd($cartProducts);
        return view('livewire.pages.cart-component', compact('cartProducts'));
    }

    public function clearAll()
    {
        Cart::destroy();
    }

    public function deleteCartItem($rowId)
    {
        Cart::remove($rowId);
        $this->dispatch('Product_deleted_from_cart');
        toastr()->error(__('Product has been deleted from cart!'));
    }
}
