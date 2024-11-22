<?php

namespace App\Livewire\Admin\Delivery;

use App\Models\DeliveryArea;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Delivery Area Create')]
class DeliveryAreaCreate extends Component
{
    public $area_name;
    public $min_delivery_time;
    public $max_delivery_time;
    public $delivery_fee;
    public $status = 1;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.delivery.delivery-area-create');
    }

    protected $rules = [
        'area_name' => ['required','string','max:255'],
        'min_delivery_time' => ['required','string','max:255'],
        'max_delivery_time' => ['required','string','max:255'],
        'delivery_fee' => ['required', 'numeric'],
        'status' => ['required', 'boolean'],
        ];

    public function create()
    {
        $this->validate();
        $deliveryArea = DeliveryArea::create([
            'area_name' => $this->area_name,
            'min_delivery_time' => $this->min_delivery_time,
            'max_delivery_time' => $this->max_delivery_time,
            'delivery_fee' => $this->delivery_fee,
            'status' => $this->status,
        ]);

        flash()->success(__('Delivery area has been added.'));
        $this->reset('area_name', 'min_delivery_time', 'max_delivery_time','delivery_fee', 'status');
        return redirect()->route('admin.delivery-area');
    }

    public function cancel()
    {
        $this->reset();
        $this->redirect(route('admin.delivery-area'), navigate:true);
    }

}
