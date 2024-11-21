<?php

namespace App\Livewire\Admin\Delivery;

use App\Models\DeliveryArea;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Delivery Area List')]
class DeliveryAreaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $delId;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $categories = '';
        $areas = DeliveryArea::orderBy('id', 'desc')->paginate(5);
        return view('livewire.admin.delivery.delivery-area-component', compact('categories', 'areas'));
    }

    public function deleteId($id)
    {
        $this->delId = $id;
    }

    public function destroy()
    {
        try {
            DeliveryArea::findOrFail($this->delId)->delete();
            $this->dispatch('closeModal');
        } catch (\Exception $e) {
            $this->dispatch('closeModal');
            \Log::error('Error deleting coupon: '. $e->getMessage());
            toastr()->error('Error deleting delivery area. Please try again later.');
        }
    }
}
