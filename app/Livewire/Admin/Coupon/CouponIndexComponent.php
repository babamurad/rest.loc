<?php

namespace App\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\On;

#[Title('Coupon')]
class CouponIndexComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $delId;

    #[On('applyCoupon')]
    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->paginate(6);
        return view('livewire.admin.coupon.coupon-index-component', compact('coupons'));
    }

    public function getDelId($id)
    {
        $this->delId = $id;
    }

    public function destroy()
    {
        try {
            // Perform any necessary database operations here to delete the coupon.
            // For example, you can use Laravel's Eloquent ORM to delete the coupon.
             $coupon = Coupon::findOrFail($this->delId);
             $coupon->delete();
             $this->delId = null;
             $this->dispatch('closeModal');
             toastr()->success('Coupon deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors that may occur during deletion.
            // For example, you can log the error or display an error message to the user.
            $this->dispatch('closeModal');
            \Log::error('Error deleting coupon: '. $e->getMessage());
            toastr()->error('Error deleting coupon. Please try again later.');
        }
    }
}
