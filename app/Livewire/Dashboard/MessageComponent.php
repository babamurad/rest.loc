<?php

namespace App\Livewire\Dashboard;

use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Pusher\Pusher;

class MessageComponent extends Component
{
    public $message;
    public $chats;
    public $senderId;

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:1000',
        ]);

        $chat = Chat::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => User::where('role', 'admin')->first()->id,
            'message' => $this->message,
        ]);

        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        
        $pusher->trigger('message-sent', 'message-event', [
            'message' => $this->message,
            'sender_id' => Auth::user()->id,
            'receiver_id' => User::where('role', 'admin')->first()->id,
            'created_at' => $chat->created_at,
        ]);

        $this->message = '';
        $this->dispatch('messageSent');
    }

    public function getListeners()
    {
        return [
            'echo-private:message-sent.message-event' => 'refreshMessages',
            'message-sent' => 'refreshMessages'
        ];
    }

    public function refreshMessages($data = null)
    {        
        $this->chats = Chat::orwhere('sender_id', Auth::user()->id)
        ->orWhere('receiver_id', Auth::user()->id)
        ->orderBy('created_at', 'asc')
        ->get();
    } 
    
    public function markMessagesAsRead()
    {
        Chat::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $this->dispatch('new-message');
    }

    #[On('change-profile-image')]
    public function render()
    {
        $this->chats = Chat::orwhere('sender_id', Auth::user()->id)
            ->orWhere('receiver_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
        //dd($chats);

        return view('livewire.dashboard.message-component');
    }
}
