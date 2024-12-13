<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Events\RTOrderPlacedNotificationEvent;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPlacedNotification;
use Illuminate\Notifications\Notifiable;
use Livewire\Component;
use App\Helpers\CalcCart;
use Cart;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;

class PaymentComponent extends Component
{
    use Notifiable;
    public $order;
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

    public function sendMessage()
    {
        $message = 'Your order has been accepted';
        event(new MessageSent($message));
        return response()->json(['status' => 'Message sent!']);
    }

    public function invoice()
    {
        // event(new RTOrderPlacedNotificationEvent/TestNotofication(['order' => $this->order]));
        // event(new RTOrderPlacedNotificationEvent($this->order));

//            CalcCart::createOrder();
            if ($this->createOrder()) {

//                $message = 'Your order has been accepted';
//
//                broadcast(new MessageSent($message));
                //broadcast(new MessageSent('Test message'));

                //return response()->json(['status' => 'Message sent!']);
                //redirect user to payment host

               /*  session()->forget('address');
                session()->forget('deliveryPrice');
                session()->forget('discount');
                Cart::destroy(); */
                toastr()->success(message: __(key: 'Your order has been accepted'));

            } else {
                toastr()->error(__('Failed to create order. Please try again later'));
            }
    }

    public function createOrder()
    {
        try {
            $order = new Order();
            $order->invoice_id = CalcCart::generateInvoiceId();
            $order->user_id = Auth::id();
            $order->address_id = session()->get('address');
            $order->discount = CalcCart::getDiscount(CalcCart::cartTotal());
            $order->delivery_charge = session()->get('deliveryPrice') ?? 0;
            $order->subtotal = CalcCart::cartTotal();
            $total = CalcCart::cartTotal() + session()->get('deliveryPrice');
            $order->grand_total = $total - session()->get('discount');
            $order->product_qty = Cart::content()->count();
            $order->payment_method = 'Cash on delivery';
            $order->payment_status = 'PENDING';
            $order->payment_approve_date = null;
            $order->transection_id = null;
            $order->coupon_info = json_encode(session()->get('coupon'));
            $order->currency_name = null;
            $order->order_status = 'PENDING';
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



            $this->order = $order;

            $this->notification();
            //$this->dispatch('order-created');

            return true;
        }catch (\Exception $e) {
            logger($e);
            return false;
        }
    }


    public function notification()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );


            $pusher->trigger('order-placed', 'order-event', $this->order);

            OrderPlacedNotification::create([
                'order_id' => $this->order->id,
                //'user_id' => $this->order->user_id,
                'message' => '#' . $this->order->invoice_id . __(' a new order has been placed!'),
                'created_at' => now()
            ]);
    }
}
