<?php

namespace App\Livewire\Pages;

use App\Models\Coupon;
use App\Models\Product;
use Livewire\Component;
use Cart;
use Livewire\Attributes\On;

class CartComponent extends Component
{
    public $productTotal;
    public $cartTotalSum;
    public $delivery = 10;
    public $discount = 0;
    public $discount_type;
    public $coupon_code;
    public $coupon_active = false;
    public $rowTotal;

    #[On('Product_added_to_cart')]
    #[On('Product_deleted_from_cart')]
    public function render()
    {
        //Cart::destroy();
        $cartProducts = Cart::content();
//        dd($cartProducts);
        $this->cartTotalSum = $this->cartTotal();
        return view('livewire.pages.cart-component', compact('cartProducts'));
    }

    public function decreaseQty($id, $rowId)
    {
        $product =Product::findOrfail($id);
        $cartItem = Cart::get($rowId);
        $qty = $cartItem->qty - 1;
        if ($product->quantity >= $qty && $qty >= 1) {

            Cart::update($rowId, $qty);
            $this->calcRowTotal($rowId);
            $this->cartTotal();
        } else {

            toastr()->error('Минимальное количество заказа 1 единица.');
        }

    }

    public function increaseQty($id, $rowId)
    {
        $product =Product::findOrfail($id);
        $cartItem = Cart::get($rowId);
        $qty = $cartItem->qty + 1;
        if ($product->quantity >= $qty && $qty >= 1) {
            Cart::update($rowId, $qty);
            $this->calcRowTotal($rowId);
            $this->cartTotal();
        } else {
            toastr()->error('Данный продукт недоступен в таком количестве. Доступно только ' . $product->quantity . ' единиц.');
        }
    }

    public function calcRowTotal($rowId)
    {
        $product = Cart::get($rowId);
        $productPrice = $product->price;
        $sizePrice = $product->options['product_size']['price']?? 0;
        $optionsPrice = 0;
        foreach ($product->options['product_options'] as $option) {
            $optionsPrice += $option['price'];
        }
        $this->rowTotal = ($productPrice + $sizePrice) * $product->qty + $optionsPrice;

        Cart::update($rowId, ['weight' => $this->rowTotal]);
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

    public function noCoupon($message)
    {
        toastr()->error(__($message));
        $this->discount_type = null;
        $this->discount = 0;
        $this->coupon_active = false;
    }

    public function applyCoupon()
    {
        $coupon = Coupon::where('code', $this->coupon_code)->first();
        //dd(now() . ' -- ' . $coupon->expire_date);
        if (!$coupon) {
            $this->noCoupon(__('Coupon not found!'));
            return;
        } elseif ($coupon->quantity <= 0) {
            $this->noCoupon(__('Coupon has been fully redeemed'));
            return;
        } elseif ($coupon->expire_date < now()) {
            $this->noCoupon(__('Coupon has been expired.'));
            return;
        } else {
            $coupon->quantity = $coupon->quantity - 1;
            $this->coupon_active = true;
            $this->discount_type = $coupon->discount_type;
            $this->discount = $coupon->discount;
            $coupon->update();
            $this->dispatch('applyCoupon');
            toastr()->success(__('Coupon applied successfully!'));
        }
    }
}
