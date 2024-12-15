<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
class AdminChatConversation extends Component
{
    public $userId;
    public $message;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $chats = Chat::whereIn('sender_id', [Auth::user()->id, $this->userId])
            ->orWhereIn('receiver_id', [Auth::user()->id, $this->userId])
            ->orderBy('created_at', 'asc')
            ->get();
        return view('livewire.admin.admin-chat-conversation', compact('chats'));
    }

    public function mount($id = null)
    {
        if ($id) {
            $this->userId = $id;
        } else {
            $this->userId = Auth::user()->id;
        }
    }

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
}
