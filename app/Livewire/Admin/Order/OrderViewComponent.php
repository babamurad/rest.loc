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

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
//        dd($this->order->address->deliveryArea->area_name);
        return view('livewire.admin.order.order-view-component');
    }

    public function mount($id)
    {
        $this->order = Order::with('orderItems', 'user', 'address')->findOrFail($id);
    }
}
