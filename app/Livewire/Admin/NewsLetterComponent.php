<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Subscriber;

#[Title('Setting')]
class NewsLetterComponent extends Component
{
    public $search;
    public $open;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $subscribes = Subscriber::paginate(10);
        return view('livewire.admin.news-letter-component', compact('subscribes'));
    }
}
