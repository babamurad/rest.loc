<?php

namespace App\Livewire\Partials;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MessageIcon extends Component
{    
    public $unreadMessages = 0;

    // Убираем лишние слушатели, так как теперь используем Pusher
    protected $listeners = [
        'updateUnreadCount' => 'updateUnreadCount'
    ];

    public function mount()
    {
        $this->updateUnreadCount();
        
        Chat::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    public function updateUnreadCount()
    {
        $this->unreadMessages = Chat::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();
    }
    
    public function render()
    {
        return view('livewire.partials.message-icon');
    }
}
