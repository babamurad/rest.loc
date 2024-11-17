<?php

namespace App\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Coupon')]
class CouponComponent extends Component
{

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $coupons = Coupon::all();
        return view('livewire.admin.coupon-component',compact('coupons'));
    }
}
