<?php

namespace App\Livewire\Admin\Coupon;
use App\Models\Coupon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Coupon Edit')]
class CouponEditComponent extends Component
{
    public $editId, $name, $code, $quantity, $min_purchase_amount, $expire_date, $discount_type, $discount, $status;

    protected $rules = [
        'name' => ['required','string','max:255'],
        'code' => ['required','string','max:50'],
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
        return view('livewire.admin.coupon.coupon-edit-component');
    }

    public function mount($id)
    {
        $coupon = Coupon::findOrFail($id);
        $this->editId = $coupon->id;
        $this->name = $coupon->name;
        $this->code = $coupon->code;
        $this->quantity = $coupon->quantity;
        $this->min_purchase_amount = $coupon->min_purchase_amount;
        $this->expire_date = $coupon->expire_date;
        $this->discount_type = $coupon->discount_type;
        $this->discount = $coupon->discount;
        $this->status = $coupon->status;
    }

    public function update()
    {
        $this->validate();
        $coupon = Coupon::find($this->editId);
        $coupon->id = $this->editId;
        $coupon->name = $this->name;
        $coupon->code = $this->code;
        $coupon->quantity = $this->quantity;
        $coupon->min_purchase_amount = $this->min_purchase_amount;
        $coupon->expire_date = $this->expire_date;
        $coupon->discount_type = $this->discount_type;
        $coupon->discount = $this->discount;
        $coupon->status = $this->status;
        $coupon->update();
//        $coupon->update($this->validateData());
        toastr()->success('Coupon has been updated successfully.');
        redirect()->route('admin.coupon');
        $this->reset(['name', 'code', 'quantity','min_purchase_amount', 'expire_date', 'discount_type', 'discount','status']);
    }

    public function cancel()
    {
        $this->reset();
        $this->redirect(route('admin.coupon'), navigate:true);
    }
}
