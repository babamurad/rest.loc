<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Orders')]
class OrderIndexComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $orders = Order::with('orderItems', 'user')->orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.admin.order.order-index-component', compact('orders'));
    }

    public function deleteId()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
