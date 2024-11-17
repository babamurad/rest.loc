<?php

namespace App\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Coupon Create')]
class CouponCreateComponent extends Component
{
    public $name, $code, $quantity, $min_purchase_amount, $expire_date, $discount_type, $discount, $status;

    protected $rules = [
        'name' => ['required','string','max:255'],
        'code' => ['required','string','max:50','unique:coupons,code'],
        'quantity' => ['required','integer'],
        'min_purchase_amount' => ['required','numeric'],
        'expire_date' => ['required','date'],
        'discount_type' => ['required','string'],
        'discount' => ['required'],
        'status' => ['required','boolean'],
    ];

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.coupon.coupon-create-component');
    }

    public function create()
    {
        $this->validate();

        Coupon::create([
            'name' => $this->name,
            'code' => $this->code,
            'quantity' => $this->quantity,
            'min_purchase_amount' => $this->min_purchase_amount,
            'expire_date' => $this->expire_date,
            'discount_type' => $this->discount_type,
            'discount' => $this->discount,
            'status' => $this->status,
        ]);
        toastr()->success('Coupon has been created successfully.');
        redirect()->route('admin.coupon');
        $this->reset();
    }

    public function cancel()
    {
        $this->reset();
        $this->redirect(route('admin.coupon'), navigate:true);
    }
}
