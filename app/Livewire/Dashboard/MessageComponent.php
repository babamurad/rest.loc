<?php

namespace App\Livewire\Dashboard;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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

        $this->message = '';
        toastr()->success(__('Message sent successfully'));
    }

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
