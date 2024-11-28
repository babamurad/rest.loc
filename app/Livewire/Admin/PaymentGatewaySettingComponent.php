<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Setting')]
class PaymentGatewaySettingComponent extends Component
{
    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.payment-gateway-setting-component');
    }
}
