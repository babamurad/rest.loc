<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use App\Models\Banner;

class BannerComponent extends Component
{
    public function render()
    {
        $banners = Banner::where('status', 1)->get();
        return view('livewire.partials.banner-component', compact('banners'));
    }
}
