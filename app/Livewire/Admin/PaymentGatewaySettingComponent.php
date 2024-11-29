<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Setting')]
class PaymentGatewaySettingComponent extends Component
{
    public $status, $paypal_account_mode, $paypal_country, $paypal_currency, $client_id, $secret_key, $paypal_logo;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.payment-gateway-setting-component');
    }
}
