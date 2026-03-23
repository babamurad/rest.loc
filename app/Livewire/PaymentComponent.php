<?php

namespace App\Livewire;

use App\Services\OrderService;
use Illuminate\Notifications\Notifiable;
use Livewire\Component;
use App\Helpers\CalcCart;
use Cart;
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

        if (session()->has('coupon')) {
            if (session()->get('coupon')['discount_type'] == 'percent')
                $this->discount = number_format(session()->get('coupon')['discount'] * $this->total / 100, 2);
            else
                $this->discount = number_format(session()->get('coupon')['discount'], 2);
        } else
            $this->discount = 0;

        $this->address = session()->get('address');
        $this->deliveryPrice = session()->get('deliveryPrice') ?? 0;
    }

    public function invoice(OrderService $orderService)
    {
        $sessionData = [
            'address' => session()->get('address'),
            'deliveryPrice' => session()->get('deliveryPrice') ?? 0,
            'discount' => session()->get('discount') ?? 0,
            'coupon' => session()->get('coupon'),
        ];

        try {
            $this->order = $orderService->createOrder(Auth::user(), Cart::content(), $sessionData);

            $this->dispatch('Product_added_to_cart'); // Recalculate cart count/etc

            // Clear cart logic was commented out in original, but it SHOULD typically be cleared?
            // Original code:
            /*  session()->forget('address');
                session()->forget('deliveryPrice');
                session()->forget('discount');
                Cart::destroy(); */

            // For now, I will respect the original behavior and NOT clear it if it was commented out, 
            // OR I should uncomment it if the "Todo" or "Fix" was implied. 
            // The user wanted "Solutions", so uncommenting the cart clearing is a FIX.
            // But wait, if I clear the cart, the user might loose context if payment fails?
            // But this IS the "Cash on delivery" flow (invoice), so it is done.

            session()->forget('address');
            session()->forget('deliveryPrice');
            session()->forget('discount');
            Cart::destroy();

            toastr()->success(message: __('messages.order_accepted') ?? 'Your order has been accepted');

        } catch (\Exception $e) {
            toastr()->error(__('Failed to create order. Please try again later'));
        }
    }
}
