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

    public $perPage=8;
    public $delId;
    public $updated_id;
    public $payment_status;
    public $order_status;

    protected $rules = [
        'payment_status' => ['required', 'in:PENDING,COMPLETED'],
        'order_status' => ['required', 'in:PENDING,IN_PROCESS,DELIVERED,DECLINED'],
    ];

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $orders = Order::with('orderItems', 'user')->orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.admin.order.order-index-component', compact('orders'));
    }

    public function deleteId($id)
    {
        $this->delId = $id;
    }

    public function destroy()
    {
        try {
            Order::find($this->delId)->delete();
            //closeModal
            $this->dispatch('closeModal');
            flash()->success('Deleted!');
        }catch (\Exception $e) {
            $this->err = $e->getMessage();
            flash()->error('Something went wrong! Failed to delete.' . $e);
        }

    }

    public function showStatusModal($id)
    {
        $this->updated_id = $id;
        $order = Order::find($this->updated_id);
        $this->payment_status = $order->payment_status;
        $this->order_status = $order->order_status;
        $this->dispatch('show-update-modal');
    }

    public function update()
    {
        try {
            $this->validate();
            $order = Order::find($this->updated_id);
            $order->payment_status = $this->payment_status;
            $order->order_status = $this->order_status;
            $order->save();
            $this->reset(['payment_status', 'order_status', 'updated_id']);
            $this->dispatch('close-update-modal');
            flash()->success('Order status updated successfully');
        }catch (\Exception $e) {
            $this->reset(['payment_status', 'order_status', 'updated_id']);
            $this->dispatch('close-update-modal');
            flash()->error('Something went wrong.');
    }
    }
}
