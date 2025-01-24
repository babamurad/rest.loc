<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\FooterInfo;

#[Title('Footer Info')]
class FooterInfoComponent extends Component
{
    public $footer_info;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $this->footer_info = FooterInfo::find(1);
        return view('livewire.admin.footer-info-component');
    }
}
