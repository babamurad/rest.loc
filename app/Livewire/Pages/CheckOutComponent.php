<?php

namespace App\Livewire\Pages;

use App\Models\Address;
use Livewire\Component;
use Cart;

class CheckOutComponent extends Component
{
    public $delivery = 10;
    public $discount = 0;

    public function render()
    {
//        $adresses = Address::with('user')->get();
        $addresses = auth()->user()->addresses();
        return view('livewire.pages.check-out-component', compact('addresses'));
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
            //dd($item->qty);
        }
        $this->cartTotalSum = $total;
        return $total;
    }
}
