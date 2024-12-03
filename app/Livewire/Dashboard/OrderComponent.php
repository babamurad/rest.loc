<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $selectOrder;
    public $viewOrder = false;

    public $perPage=8;

    public function render()
    {
        $orders = auth()->user()->orders()->paginate($this->perPage);
        return view('livewire.dashboard.order-component', compact('orders'));
    }

    public function mount()
    {
        $this->selectOrder = Order::with('orderItems', 'address')->first();
    }

    public function invoice($id)
    {
        $this->selectOrder = Order::with('orderItems', 'user', 'address')->findOrFail($id);
        $this->viewOrder = true;
        //dd($this->selectOrder);
    }
}
