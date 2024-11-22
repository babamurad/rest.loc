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
    public $type;

    public function render()
    {
        $areas = DeliveryArea::where('status', 1)->orderBy('area_name', 'asc')->get();
        return view('livewire.dashboard.address', compact('areas'));
    }

    public function save()
    {
        $this->validate();
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

    }

}
