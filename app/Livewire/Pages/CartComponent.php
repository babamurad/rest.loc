<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Cart;
use Livewire\Attributes\On;

class CartComponent extends Component
{
    public $productTotal;
    public $cartTotalSum;
    public $qrty;

    #[On('Product_added_to_cart')]
    #[On('Product_deleted_from_cart')]
    public function render()
    {
        $cartProducts = Cart::content();
        $this->cartTotalSum = $this->cartTotal();
        return view('livewire.pages.cart-component', compact('cartProducts'));
    }

    public function cartTotal($qty = null, $action = null, $rowId = null)
    {
        if ($qty !== null && $qty !== 1 && $action !== null && $rowId !== null) {
            //$qty += ($action === 'inc') ? 1 : -1;
            Cart::update($rowId, $qty);
            $this->qrty =$qty;
        }

        $total = 0;
        foreach (Cart::content() as $item) {
            $productPrice = $item->price;
            $sizePrice = $item->options['product_size']['price']?? 0;
            $optionsPrice = 0;
            foreach ($item->options['product_options'] as $option) {
                $optionsPrice += $option['price'];
            }
            $total += ($productPrice + $sizePrice) * $item->qty + $optionsPrice;
            //dd($item->qty);
        }
        $this->cartTotalSum = $total;
        return $total;
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
