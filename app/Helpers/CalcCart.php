<?php


namespace App\Helpers;

use App\Models\Order;
use Cart;


class CalcCart
{
    public static function cartTotal()
    {
        $total = 0;
        foreach (Cart::content() as $item) {
            $productPrice = $item->price;
            $sizePrice = $item->options['product_size']['price'] ?? 0;
            $optionsPrice = 0;
            foreach ($item->options['product_options'] as $option) {
                $optionsPrice += $option['price'];
            }
            $total += ($productPrice + $sizePrice) * $item->qty + $optionsPrice;
        }
        return $total;
    }

    /** Create Order in Database */
    public static function createOrder()
    {
        // Database connection and order creation logic
        // Here you would insert the customer data and order details into your database
        // and return the order ID
        // Example: $orderID = DB::table('orders')->insertGetId($customerData);
        // return $orderID;
        $order = new Order();
        $order->invoice_id = CalcCart::generateInvoiceId();
        $order->user_id = auth()->user()->id;
        $order->address = session()->get('address');
        $order->discount = self::getDiscount(self::cartTotal());
        $order->delivery_charge = session()->get('deliveryPrice') ?? 0;
        $order->subtotal = self::cartTotal();
        $total = self::cartTotal() + session()->get('deliveryPrice');
        $order->grand_total = $total - session()->get('discount');
        $order->product_qty = Cart::content()->count();
        $order->payment_method = null;
        $order->payment_status = 'pending';
        $order->payment_approve_date = null;
        $order->transection_id = null;
        $order->coupon_info = json_encode(session()->get('coupon'));
        $order->currency_name = null;
        $order->order_status = 'pending';
        $order->save();

    }

    /** Clear Session Items */
    public static function clearCartSession()
    {
        Cart::destroy();
    }

    public static function getDiscount($total)
    {
        if(session()->has('coupon')) {
            if(session()->get('coupon')['discount_type'] == 'percent')
                $discount = number_format(session()->get('coupon')['discount'] * $total / 100, 2);
            else
                $discount = number_format(session()->get('coupon')['discount'], 2);
        } else
            $discount = 0;
        return $discount;
    }

    /** Apply Coupon */
    public static function applyCoupon($couponCode)
    {
        // Database connection and coupon application logic
        // Here you would retrieve the coupon details from your database
        // and apply it to the cart if the code matches
    }

    public static function generateInvoiceId()
    {
        $randomNumber = rand(1, 9999);
        $currentDateTime = now();
        $invoiceId = $randomNumber.$currentDateTime->format('yd').$currentDateTime->format('s');
        return $invoiceId;
    }
}
