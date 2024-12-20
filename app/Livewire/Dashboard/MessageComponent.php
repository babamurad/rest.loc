<?php

namespace App\Livewire\Dashboard;

use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Pusher\Pusher;

class MessageComponent extends Component
{
    public $message;

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:1000',
        ]);

        Chat::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => 3,
            'message' => $this->message,
        ]);

        // Используем существующий MessageSent event
        event(new MessageSent($this->message));

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
        $pusher->trigger('message-sent', 'message-event', $this->message);

        $this->message = '';
        toastr()->success(__('Message sent successfully'));
    }

    #[On('change-profile-image')]
    public function render()
    {
        $chats = Chat::orwhere('sender_id', Auth::user()->id)
            ->orWhere('receiver_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
        //dd($chats);

        return view('livewire.dashboard.message-component', compact('chats'));
    }
}
