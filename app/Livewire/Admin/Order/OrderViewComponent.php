<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Orders')]
class OrderViewComponent extends Component
{
    public $order;
    public $payment_status;
    public $order_status;

    protected $rules = [
        'payment_status' => ['required', 'in:pending,completed'],
        'order_status' => ['required', 'in:pending,in_process,delivered,declined'],
    ];

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
//        dd($this->order->address->deliveryArea->area_name);
//        dd($this->order->address);
        return view('livewire.admin.order.order-view-component');
    }

    public function mount($id)
    {
        $this->order = Order::with('orderItems', 'user', 'address')->findOrFail($id);
        $this->payment_status = $this->order->payment_status;
        $this->order_status = $this->order->order_status;
    }

    public function update()
    {
        //dd($this->payment_status . ' - ' .  $this->order_status);
        $this->validate();
        //dd('validate');

        $this->order->payment_status = $this->payment_status;
        $this->order->order_status = $this->order_status;
        $this->order->save();
        toastr()->success('Order status updated successfully');
    }
}
