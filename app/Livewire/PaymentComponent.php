<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use App\Helpers\CalcCart;
use Cart;

class PaymentComponent extends Component
{
    public $total;
    public $deliveryPrice;
    public $discount;
    public $address;

    public function render()
    {
        return view('livewire.payment-component');
    }

    public function mount()
    {
        $this->total = CalcCart::cartTotal();

        if(session()->has('coupon')) {
            if(session()->get('coupon')['discount_type'] == 'percent')
                $this->discount = number_format(session()->get('coupon')['discount'] * $this->total / 100, 2);
            else
                $this->discount = number_format(session()->get('coupon')['discount'], 2);
        } else
            $this->discount = 0;
        $this->address = session()->get('address');
        $this->deliveryPrice = session()->get('deliveryPrice') ?? 0;
    }

    public function invoice()
    {
//            CalcCart::createOrder();
            if ($this->createOrder()) {
                //redirect user to payment host
//                session()->forget('address');
//                session()->forget('deliveryPrice');
//                session()->forget('discount');
//                Cart::destroy();
                toastr()->success(__('Your order has been accepted'));
            } else {
                toastr()->error(__('Failed to create order. Please try again later'));
            }
    }

    public function createOrder()
    {

        try {
            $order = new Order();
            $order->invoice_id = CalcCart::generateInvoiceId();
            $order->user_id = auth()->user()->id;
            $order->address_id = session()->get('address');
            $order->discount = CalcCart::getDiscount(CalcCart::cartTotal());
            $order->delivery_charge = session()->get('deliveryPrice') ?? 0;
            $order->subtotal = CalcCart::cartTotal();
            $total = CalcCart::cartTotal() + session()->get('deliveryPrice');
            $order->grand_total = $total - session()->get('discount');
            $order->product_qty = Cart::content()->count();
            $order->payment_method = 'Cash on delivery';
            $order->payment_status = 'pending';
            $order->payment_approve_date = null;
            $order->transection_id = null;
            $order->coupon_info = json_encode(session()->get('coupon'));
            $order->currency_name = null;
            $order->order_status = 'pending';
            $order->save();

            foreach (\Cart::content() as $product) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_name = $product->name;
                $orderItem->product_id = $product->id;
                $orderItem->qty = $product->qty;
                $orderItem->unit_price = $product->price;
                $orderItem->product_size = json_encode($product->options->product_size);
                $orderItem->product_option = json_encode($product->options->product_options);
                $orderItem->save();
            }
            $this->dispatch('Product_added_to_cart');
            return true;
        }catch (\Exception $e) {
            logger($e);
            return false;
        }
    }
}
