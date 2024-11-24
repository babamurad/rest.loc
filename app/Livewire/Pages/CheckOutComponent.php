<?php

namespace App\Livewire\Pages;

use App\Models\Address;
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
        $addresses = Address::where('user_id', auth()->user()->id)->with('deliveryArea')->get();
        //dd($addresses->count());
        $areas = DeliveryArea::where('status', 1)->orderBy('area_name', 'asc')->get();
        return view('livewire.pages.check-out-component', compact('addresses', 'areas'));
    }

    public function save()
    {
        $this->validate();
        //dump($this->type);
        //dd('validate');
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
            //dd($item->qty);
        }
        $this->cartTotalSum = $total;
        return $total;
    }
}
