<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Cart;
use Livewire\Attributes\On;

class MenuCart extends Component
{
    public $cartTotalSum;

    #[On('Product_added_to_cart')]
    public function render()
    {
        $cartProducts = Cart::content();
        $this->cartTotalSum = $this->cartTotal();
        //Cart::destroy();
        //dd($cartProducts);
        return view('livewire.components.menu-cart', compact('cartProducts'));
    }

    public function deleteCartItem($rowId)
    {
        Cart::remove($rowId);
        $this->dispatch('Product_deleted_from_cart');
        toastr()->error(__('Product has been deleted from cart!'));
    }

    public function cartTotal()
    {
        $total = 0;
        foreach (Cart::content() as $item) {
            $productPrice = $item->price;
            $sizePrice = $item->options['product_size']['price']?? 0;
            $optionsPrice = 0;
            foreach ($item->options['product_options'] as $option) {
                $optionsPrice += $option['price'];
            }
            $total += ($productPrice + $sizePrice) * $item->qty + $optionsPrice;
        }
        return $total;
    }
}
