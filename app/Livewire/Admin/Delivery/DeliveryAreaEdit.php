<?php

namespace App\Livewire\Admin\Delivery;

use App\Models\DeliveryArea;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Delivery Area Edit')]
class DeliveryAreaEdit extends Component
{
    public $area_name;
    public $min_delivery_time;
    public $max_delivery_time;
    public $delivery_fee;
    public $status;
    public $editId;

    protected $rules = [
        'area_name' => ['required','string','max:255'],
        'min_delivery_time' => ['required','string','max:255'],
        'max_delivery_time' => ['required','string','max:255'],
        'delivery_fee' => ['required', 'numeric'],
        'status' => ['required', 'boolean'],
    ];

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.delivery.delivery-area-edit');
    }

    public function mount($id)
    {
        $area = DeliveryArea::findOrFail($id);
        $this->editId = $id;
        $this->area_name = $area->area_name;
        $this->min_delivery_time = $area->min_delivery_time;
        $this->max_delivery_time = $area->max_delivery_time;
        $this->delivery_fee = $area->delivery_fee;
        $this->status = $area->status;
    }

    public function update()
    {
        $this->validate();
        DeliveryArea::find($this->editId)->update([
            'area_name' => $this->area_name,
            'min_delivery_time' => $this->min_delivery_time,
            'max_delivery_time' => $this->max_delivery_time,
            'delivery_fee' => $this->delivery_fee,
            'status' => $this->status,
            ]);

        toastr()->success('Delivery Area has been updated successfully.');
        $this->reset();
        redirect()->route('admin.delivery-area');
    }

    public function cancel()
    {
        $this->reset();
        $this->redirect(route('admin.delivery-area'), navigate:true);
    }
}
