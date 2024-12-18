<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
class AdminChatConversation extends Component
{
    public $senderId = 7;
    public $senderName;
    public $message;

    #[Layout('livewire.admin.layouts.admin-app')]
    #[On('chat-message-sent')]
    #[On('sender-id-set')]
    public function render()
    {
        $chats = Chat::where('sender_id', $this->senderId)
            //->orWhere('receiver_id', $this->senderId)
            ->orderBy('created_at', 'asc')
            ->get();
        //dd($chats);

        return view('livewire.admin.admin-chat-conversation', [
            'chats' => $chats,
            'senderId' => $this->senderId,
        ]);
    }

    public function mount($id = null)
    {
        if ($id) {
            $this->senderId = $id;
        } else {
            $this->senderId = Auth::user()->id;
        }

        $this->senderName = User::find($this->senderId)->name;
        //dd($this->senderId);
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:1000',
        ]);

        Chat::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $this->senderId,
            'message' => $this->message,
        ]);

        $this->message = '';
        toastr()->success(__('Message sent successfully'));
    }
}
