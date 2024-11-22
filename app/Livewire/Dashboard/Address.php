<?php

namespace App\Livewire\Dashboard;

use App\Models\DeliveryArea;
use Livewire\Component;

class Address extends Component
{
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
//        'user_id' => ['required','integer'],
//        'icon' => ['required','image'],
//        'delivery_area_id' => ['required','integer'],

////            'email' => ['required','email','max:255','unique:addresses,email,'. $this->id],
//        'email' => ['required','email'],
//        'phone' => ['required','string','max:255'],
//        'type' => ['required','integer'],
    ];

    public function render()
    {
        $areas = DeliveryArea::where('status', 1)->orderBy('area_name', 'asc')->get();
        return view('livewire.dashboard.address', compact('areas'));
    }

    public function save()
    {
//        dd('Save address');
        $this->validate();
        dd('validate');
        $address = new \App\Models\Address();
        $address->user_id = $this->user_id;
        $address->icon = $this->icon;
        $address->delivery_area_id = $this->delivery_area_id;
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->email = $this->email;
        $address->phone = $this->phone;
        $address->type = $this->type;
        $address->save();
        toastr()->success(__('Address has been added.'));
    }

    public function cancel()
    {
        $this->reset();
    }

}
