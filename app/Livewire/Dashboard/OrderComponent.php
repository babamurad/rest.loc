<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('User Orders')]
class OrderComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $selectOrder;
    public $viewOrder = false;

    public $perPage=14;


    public function render()
    {
        $orders = Auth::user()->orders()->orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.dashboard.order-component', compact('orders'));
    }

    public function invoice($id)
    {
        $this->selectOrder = Order::with('orderItems', 'user', 'address')->findOrFail($id);
        $this->viewOrder = true;
    }
}
