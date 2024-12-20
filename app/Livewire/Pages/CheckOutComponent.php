<?php

namespace App\Livewire\Pages;

use App\Helpers\CalcCart;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\DeliveryArea;
use Livewire\Component;
use Cart;

class CheckOutComponent extends Component
{
    public $delivery = 10;
    public $discount = 0;

    public $address;
    public $user_id;
    public $icon;
    public $delivery_area_id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $type = 'home';

    public $cartTotalSum;
    public $deliveryPrice = 0;
    public $coupon_code;
    public $address_id;

    protected $rules = [
        'first_name' => ['required', 'max:255'],
        'last_name' => ['nullable','string','max:255'],
        //'user_id' => ['required','integer'],
        'delivery_area_id' => ['required','integer'],
        'email' => ['required','email'],
        'phone' => ['required','string','max:255'],
        'address' => ['required'],
        'type' => ['required'],
    ];

    public function render()
    {
        if (Cart::count() > 0) {
            if( session()->has('coupon')) {
                $this->coupon_code = session('coupon')['code'];
            } else {
                $this->discount = 0;
            }
            $this->delivery = 10;
        } else {
            session()->forget('coupon');
            $this->delivery = 0;
        }

        $this->cartTotalSum = $this->cartTotal();
        $addresses = Address::where('user_id', auth()->user()->id)->with('deliveryArea')->get();
        //dd($addresses->count());
        $areas = DeliveryArea::where('status', 1)->orderBy('area_name', 'asc')->get();
        return view('livewire.pages.check-out-component', compact('addresses', 'areas'));
    }

    public function save()
    {
        $address = new Address();
        $address->user_id = auth()->user()->id;
        $address->icon = '<i class="fas fa-home"></i>';
        $address->delivery_area_id = $this->delivery_area_id;
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->email = $this->email;
        $address->phone = $this->phone;
        $address->type = $this->type;
        $address->address = $this->address;
        $address->save();
        flash()->success(__('Address has been added.'));
        $this->dispatch('close-modal');
        $this->reset(['first_name', 'last_name', 'email', 'phone', 'type', 'address', 'delivery_area_id']);
    }

    public function cartTotal()
    {
        $total = 0;
        foreach (Cart::content() as $item) {
            $productPrice = $item->price;
            $sizePrice = $item->options['product_size']['price']?? 0;
            $optionsPrice = 0;
            foreach ($item->options['product_options'] as $option) {
                $optionsPrice += $option['price'];
            }
            $total += ($productPrice + $sizePrice) * $item->qty + $optionsPrice;
        }
        $this->cartTotalSum = $total;
        return $total;
    }

    public function getAddress($id)
    {
        $this->address_id = $id;
    }

    public function payout()
    {
        if ($this->deliveryPrice === 0)
            toastr()->error(__('Please select Address.'));
        else {
            $address = Address::with('deliveryArea')->where('id', '=', $this->address_id)->first();
            session()->put('address', $this->address_id);
            session()->put('deliveryPrice', $address->deliveryArea?->delivery_fee);
            session()->put('discount', CalcCart::getDiscount($this->cartTotalSum));
            $this->redirect('payment', navigate:true);
        }

    }

    public function cancel()
    {
        $this->dispatch('close-modal');
    }
}
