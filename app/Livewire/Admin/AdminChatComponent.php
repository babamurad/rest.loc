<?php

namespace App\Livewire\Admin;

use App\Models\Chat;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\ComponentName;

#[ComponentName('admin-chat-component')]
class AdminChatComponent extends Component
{
    public $userId;
    public $senderId;
    public $senderName;
    
    public $message;
    public $chats;
    

    #[Layout('livewire.admin.layouts.admin-app')]
    //#[On('chatUpdated')]
    public function render()
    {
        $userId = Auth::user()->id;

        $chatUsers = User::where('id', '!=', $userId)
        ->whereHas('chats', function($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->orWhere('receiver_id', $userId);
        })
        ->get()
        ->map(function($user) {
            $user->is_online = $user->isOnline();
            return $user;
        }); 

        $chatUser = $chatUsers->first();
        //dd($chatUser);

        $chats = Chat::where(function($query) use ($userId) {
            $query->where('sender_id', $this->senderId)
                  ->where('receiver_id', $userId);
        })
        ->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $this->senderId);
        })
        ->orderBy('created_at')
        ->get();        

        return view('livewire.admin.admin-chat-component', [
            'chats' => $chats,
            'chatUsers' => $chatUsers,
            'senderId' => $this->senderId,
            'chatUser' => $chatUser,
        ]);
    }

    public function mount()
    {
        $firstUser = User::where('id', '!=', Auth::user()->id)->first();
        $this->senderId = $firstUser ? $firstUser->id : null;
        $this->senderName = $firstUser ? $firstUser->name : '';

        // Инициализируем чаты
        if ($this->senderId) {
            $this->chats = Chat::where(function($query) {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $this->senderId);
            })->orWhere(function($query) {
                $query->where('sender_id', $this->senderId)
                    ->where('receiver_id', Auth::id());
            })->orderBy('created_at', 'asc')->get();
        } else {
            $this->chats = collect([]); // Пустая коллекция если нет собеседника
        }
    }

    public function setSenderId($id)
    {
        $this->senderId = $id;
        $this->senderName = User::find($id)->name;
        $this->chats = Chat::where(function($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->senderId);
        })->orWhere(function($query) {
            $query->where('sender_id', $this->senderId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        // Добавляем диспатч события при смене пользователя
        $this->dispatch('chatUpdated');
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

        $this->chats = Chat::where(function($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->senderId);
        })->orWhere(function($query) {
            $query->where('sender_id', $this->senderId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        $this->message = '';
        toastr()->success(__('Message sent successfully'));
    }

    public function getListeners()
    {
        return [
            'message-sent' => 'refreshMessages',
            'echo:chat,MessageSent' => 'refreshMessages'
        ];
    }

    public function refreshMessages()
    {
        $this->chats = Chat::where(function($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->senderId);
        })->orWhere(function($query) {
            $query->where('sender_id', $this->senderId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();
    }
}
