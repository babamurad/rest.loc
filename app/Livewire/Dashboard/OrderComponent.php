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

    public function invoice($id)
    {
        $this->selectOrder = Order::with('address')->findOrFail($id)->first();
        $this->viewOrder = true;
        //dd($this->selectOrder);
    }
}
