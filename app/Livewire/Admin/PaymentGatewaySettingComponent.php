<?php

namespace App\Livewire\Admin;

use App\Models\PaymentGatewaySetting;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

#[Title('Setting')]
class PaymentGatewaySettingComponent extends Component
{
    use WithFileUploads;
    public $paypal_country, $paypal_currency, $client_id, $secret_key, $paypal_logo, $new_logo;
    public $status = 0;
    public $paypal_account_mode = 'sandbox';
    public $activeTab;


    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.payment-gateway-setting-component');
    }

    public function mount()
    {
        $this->activeTab = $this->activeTab ?? 'altyn_asyr';
        $settings = PaymentGatewaySetting::all();

        foreach ($settings as $setting) {
            if (in_array($setting->key, ['status', 'paypal_account_mode', 'paypal_country', 'paypal_currency', 'client_id', 'secret_key', 'paypal_logo'])) {
                $this->{$setting->key} = $setting->value;
            }
        }
    }

    public function changeTab($active)
    {
        $this->activeTab = $active;
    }

    public function paypalSettingUpdate()
    {
        $validatedData = $this->validate([
            'status' => ['boolean', 'nullable'],
            'paypal_account_mode' => ['in:sandbox,live', 'nullable'],
            'paypal_country' => ['required','string'],
            'paypal_currency' => ['required','string'],
            'client_id' => ['required','string'],
            'secret_key' => ['required','string'],
            //'paypal_logo' => ['image', 'max:5000', 'nullable'],
        ]);

        if ($this->new_logo) {
            $imageName = 'uploads/images/' . Carbon::now()->timestamp.'-'.$this->new_logo->getClientOriginalName();
            $this->new_logo->storeAs($imageName);
            $validatedData['paypal_logo'] = $imageName;
        }

        foreach ($validatedData as $key => $value) {
            PaymentGatewaySetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        toastr()->success(__('Updated Successfully!'));
    }
}
