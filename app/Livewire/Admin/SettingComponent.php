<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Setting')]
class SettingComponent extends Component
{
    public $site_name = 'My Website';
    public $currency_icon = 'TMT';
    public $currency_icon_position = 'left';

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.setting-component');
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
}
