<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use App\Models\Chef;
use App\Models\WhyChooseUs;

class ChefComponent extends Component
{
    public $title;
    public $top_title;
    public $sub_title;

    public function render()
    {
        $chefs = Chef::where(['status' => 1, 'show_at_home' => 1])->get();
        return view('livewire.partials.chef-component', compact('chefs'));
    }

    public function mount()
    {
        $titles = WhyChooseUs::where('key', 3)->first();
        if ($titles) {
            $this->title = $titles->title;
            $this->top_title = $titles->top_title;
            $this->sub_title = $titles->sub_title;
        }
    }
}
