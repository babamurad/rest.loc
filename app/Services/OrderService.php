<?php

namespace App\Services;

use App\Events\MessageSent;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPlacedNotification;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CalcCart;
use Cart;
use Pusher\Pusher;

class OrderService
{
    public function createOrder($user, $cartContent, $sessionData)
    {
        try {
            $order = new Order();
            $order->invoice_id = CalcCart::generateInvoiceId();
            $order->user_id = $user->id;
            $order->address_id = $sessionData['address'] ?? null;
            $order->discount = CalcCart::getDiscount(CalcCart::cartTotal());
            $order->delivery_charge = $sessionData['deliveryPrice'] ?? 0;
            $order->subtotal = CalcCart::cartTotal();

            $total = CalcCart::cartTotal() + ($sessionData['deliveryPrice'] ?? 0);
            $order->grand_total = $total - ($sessionData['discount'] ?? 0);

            $order->product_qty = $cartContent->count();
            $order->payment_method = 'Cash on delivery';
            $order->payment_status = 'PENDING';
            $order->payment_approve_date = null;
            $order->transection_id = null;
            $order->coupon_info = json_encode($sessionData['coupon'] ?? null);
            $order->currency_name = null;
            $order->order_status = 'PENDING';
            $order->save();

            foreach ($cartContent as $product) {
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

            $this->sendNotification($order);

            return $order;
        } catch (\Exception $e) {
            logger()->error('Order creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function sendNotification(Order $order)
    {
        // Broadcast via standard Laravel event if configured, or direct Pusher trigger
        // Using direct Pusher trigger to match previous implementation but with config

        $config = config('broadcasting.connections.pusher');

        if ($config && $config['key']) {
            $options = [
                'cluster' => $config['options']['cluster'],
                'encrypted' => true
            ];

            $pusher = new Pusher(
                $config['key'],
                $config['secret'],
                $config['app_id'],
                $options
            );

            $pusher->trigger('order-placed', 'order-event', $order);
        }

        OrderPlacedNotification::create([
            'order_id' => $order->id,
            'message' => '#' . $order->invoice_id . __(' a new order has been placed!'),
            'created_at' => now()
        ]);


    }
}
