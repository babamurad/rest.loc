<?php

namespace App\Livewire\Admin;

use App\Events\RTOrderPlacedNotificationEvent;
use App\Models\Setting;
use App\Services\PaymentGatewaySettingsService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Setting')]
class SettingComponent extends Component
{
    public $site_name = 'My Website';
    public $currency_icon = 'TMT';
    public $currency_icon_position = 'left';

    public $app_id, $app_key, $app_secret, $app_cluster;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.setting-component');
    }

    public function mount()
    {
        $pusher_settings = Setting::all();
        foreach ($pusher_settings as $setting) {
            if (in_array($setting->key, [
                'app_id', 'app_key', 'app_secret', 'app_cluster',

            ])) {
                $this->{$setting->key} = $setting->value;
            }
        }
    }

    public function saveGeneral()
    {
        $this->validate([
            'site_name' => ['required', 'max:255'],
            'currency_icon' => ['required', 'max:4'],
            'currency_icon_position' => ['required', 'max:255'],
        ]);

        // Save the changes to the database
        Setting::updateOrCreate(['key' =>'site_name'], ['value' => $this->site_name]);
        Setting::updateOrCreate(['key' => 'currency_icon'], ['value' => $this->currency_icon]);
        Setting::updateOrCreate(['key' => 'currency_icon_position'], ['value' => $this->currency_icon_position]);

        toastr()->success('General settings saved successfully.');
    }

    public function updatePusherSettings()
    {
        $validatedData = $this->validate([
            'app_id' => ['required'],
            'app_key' => ['required'],
            'app_secret' => ['required'],
            'app_cluster' => ['required'],
        ]);
        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
//        dd(Setting::pluck('value', 'key'));
        /*$settingService = app(PaymentGatewaySettingsService::class);
        $settingService->clearCachedSettings();*/
        // В сервисе или хелпере
        /*foreach (Setting::pluck('value', 'key') as $key=>$value) {
            config()->set('settings.' . $key, $value);
        }*/
        toastr()->success('Pusher settings saved successfully.');
    }
}
