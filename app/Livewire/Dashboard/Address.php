<?php

namespace App\Livewire\Dashboard;

use App\Models\DeliveryArea;
use Livewire\Component;



class Address extends Component
{
    public $addresses;
    public $address;
    public $user_id;
    public $icon;
    public $delivery_area_id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $type = 'home';

    public $delId; //change with Alpine.js

    public $showForm = 'Address';

    protected $rules = [
        'first_name' => ['required', 'max:255'],
        'last_name' => ['nullable','string','max:255'],
        'user_id' => ['required','integer'],
        'delivery_area_id' => ['required','integer'],
        'email' => ['required','email'],
        'phone' => ['required','string','max:255'],
        'address' => ['required'],
        'type' => ['required'],
    ];

    public function render()
    {
        $areas = DeliveryArea::where('status', 1)->orderBy('area_name', 'asc')->get();
        $adresses = \App\Models\Address::where('user_id', auth()->user()->id)->with('deliveryArea')->get();
        //dd($adresses);
        return view('livewire.dashboard.address', compact('areas', 'adresses'));
    }

/*
    public function mount($adresses)
    {
        $this->addresses = $adresses;
    }*/

    public function save()
    {
        $this->validate();
        //dump($this->type);
        //dd('validate');
        $address = new \App\Models\Address();
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
        $address = \App\Models\Address::findorFail($this->editId);
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

    public function destroy()
    {
        try {
            \App\Models\Address::findorFail($this->delId)->delete();
            $this->dispatch('close-modal');
            $this->delId = null;
            flash()->error(__('The address entry was successfully deleted.'));
        } catch (\Exception $e) {
            $this->dispatch('close-modal');
            $this->delId = null;
            Log::error('Error deleting coupon: '. $e->getMessage());
            toastr()->error('Error deleting coupon. Please try again later.');
        }

    }

}
