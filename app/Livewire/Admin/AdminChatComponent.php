<?php

namespace App\Livewire\Admin;

use App\Models\Chat;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminChatComponent extends Component
{    
    public $userId;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $userId = Auth::user()->id;
        $chatUsers = User::where('id', '!=', $userId)
            ->whereHas('chats', function ($query) use ($userId) {
                $query->where(function ($subQuery) use ($userId) {
                    $subQuery->where('sender_id', $userId)
                        ->orWhere('receiver_id', $userId);
                });
            })
            ->distinct()
            ->get();

        $chats = Chat::with('sender')
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();
        //dd($chatUsers);
        return view('livewire.admin.admin-chat-component', compact('chats', 'chatUsers'));
    }    

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
