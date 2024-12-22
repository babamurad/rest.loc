<?php

namespace App\Livewire\Partials;

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class MessageIcon extends Component
{    
    public $unreadMessages;

    #[On('new-message')]
    public function render()
    {
        $this->unreadMessages = Chat::where('receiver_id', Auth::id())
           ->where('is_read', false)
           ->count();
        return view('livewire.partials.message-icon');
    }
}
