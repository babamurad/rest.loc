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
    public $editId;

    public $showForm = 'Address';

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
        $adresses = \App\Models\Address::where('user_id', auth()->user()->id)->with('deliveryArea')->get();
        //dd($adresses);
        return view('livewire.dashboard.address', compact('areas', 'adresses'));
    }

    public function save()
    {
        $this->validate();
        //dump($this->type);
        //dd('validate');
        $address = new \App\Models\Address();
        $address->user_id = auth()->user()->id;
        $address->icon = '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="#f86f03" d="M261.56 101.28a8 8 0 0 0-11.06 0L66.4 277.15a8 8 0 0 0-2.47 5.79L63.9 448a32 32 0 0 0 32 32H192a16 16 0 0 0 16-16V328a8 8 0 0 1 8-8h80a8 8 0 0 1 8 8v136a16 16 0 0 0 16 16h96.06a32 32 0 0 0 32-32V282.94a8 8 0 0 0-2.47-5.79Z"/><path fill="#f86f03" d="m490.91 244.15l-74.8-71.56V64a16 16 0 0 0-16-16h-48a16 16 0 0 0-16 16v32l-57.92-55.38C272.77 35.14 264.71 32 256 32c-8.68 0-16.72 3.14-22.14 8.63l-212.7 203.5c-6.22 6-7 15.87-1.34 22.37A16 16 0 0 0 43 267.56L250.5 69.28a8 8 0 0 1 11.06 0l207.52 198.28a16 16 0 0 0 22.59-.44c6.14-6.36 5.63-16.86-.76-22.97"/></svg>';
        $address->delivery_area_id = $this->delivery_area_id;
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->email = $this->email;
        $address->phone = $this->phone;
        $address->type = $this->type;
        $address->address = $this->address;
        $address->save();
        flash()->success(__('Address has been added.'));
        $this->showForm = 'Address';

    }

    public function edit($id)
    {
        $address = \App\Models\Address::find($id);
        $this->address = $address->address;
        $this->first_name = $address->first_name;
        $this->last_name = $address->last_name;
        $this->email = $address->email;
        $this->phone = $address->phone;
        $this->type = $address->type;
        $this->delivery_area_id = $address->delivery_area_id;
        $this->icon = $address->icon;
        $this->editId = $id;
    }

    public function update()
    {
        $this->validate();
        $address = \App\Models\Address::find($this->editId);
        $address->icon = $this->icon;
        $address->delivery_area_id = $this->delivery_area_id;
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->email = $this->email;
        $address->phone = $this->phone;
        $address->type = $this->type;
        $address->address = $this->address;
        $address->save();
        flash()->success(__('Address has been updated.'));
    }

    public function cancel()
    {
        $this->reset();
    }

}
