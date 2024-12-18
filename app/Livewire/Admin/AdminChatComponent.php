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
    public $senderId;
    public $senderName;
    public $message;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $userId = Auth::user()->id;
        $chatUsers = User::whereIn('id', function($query) use ($userId) {
            $query->select('sender_id')
                ->from('chats')
                ->where('receiver_id', $userId);
        })
        ->orWhereIn('id', function($query) use ($userId) {
            $query->select('receiver_id')
                ->from('chats')
                ->where('sender_id', $userId);
        })
        ->where('id', '!=', $userId)
        ->get();

        $chatUser = $chatUsers->first();
        //dd($chatUser);

        $chats = Chat::with('sender')
            ->where('sender_id', $this->senderId)
            ->orWhere('receiver_id', $this->userId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.admin.admin-chat-component', [
            'chats' => $chats,
            'chatUsers' => $chatUsers,
            'senderId' => $this->senderId,
            'chatUser' => $chatUser,
        ]);
    }

    public function setSenderId($id)
    {
        $this->senderId = $id;
        //$this->dispatch('sender-id-set');
        $this->senderName = User::find($this->senderId)->name;
        //dd($this->senderId);
    }

    public function sendMessage($senderId)
    {
        $this->validate([
            'message' => 'required|string|max:1000',
        ]);

        Chat::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $senderId,
            'message' => $this->message,
        ]);
        // dd([
        //     'sender_id' => Auth::user()->id,
        //     'receiver_id' => $senderId,
        //     'message' => $this->message,
        // ]);

        $this->message = '';
        toastr()->success(__('Message sent successfully'));
    }
}
