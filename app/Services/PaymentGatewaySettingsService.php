<?php

namespace App\Services;

use App\Models\PaymentGatewaySetting;
use Illuminate\Support\Facades\Cache;

class PaymentGatewaySettingsService
{
    function getSettings()
    {
        return Cache::rememberForever('gatewaySettings', function (){
            return PaymentGatewaySetting::pluck('value', 'key'); // ['key' => 'value']
        });
    }

    function setSettings() : void
    {
        $settings = $this->getSettings();
        config()->set('gatewaySettings', $settings);
//        Cache::set('gatewaySettings', $settings);
    }

    function clearCachedSettings() : void
    {
        Cache::forget('gatewaySettings');
    }
}
