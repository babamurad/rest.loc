<?php

namespace App\Livewire\Admin;

use App\Models\Chat;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;
use App\Events\MessageSent;
use Pusher\Pusher;

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
        ->withMax('chats', 'created_at')
        ->withCount(['chats as unread_messages' => function($query) use ($userId) {
            $query->where('receiver_id', $userId)
                  ->where('is_read', false);
        }])
        ->orderByDesc('chats_max_created_at')
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

    public function mount($id = null)
    {
        if ($id) {
            $this->senderId = $id;
        } else {
            $firstUser = User::where('id', '!=', Auth::user()->id)
                ->whereHas('chats', function($query) {
                    $query->where('receiver_id', Auth::user()->id);
                })
                ->first();

            if (!$firstUser) {
                Log::info('Нет пользователей с сообщениями');
                return;
            }
            
            $this->senderId = $firstUser->id;
            $this->senderName = $firstUser->name;

            $this->chats = Chat::where(function($query) {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $this->senderId);
            })->orWhere(function($query) {
                $query->where('sender_id', $this->senderId)
                    ->where('receiver_id', Auth::id());
            })->orderBy('created_at', 'asc')->get();
            
        }
        
        $this->setSenderId($this->senderId);
    }

    public function setSenderId($id)
    {
        $this->senderId = $id;
        $this->senderName = User::find($id)->name;
        
        // Отмечаем сообщения как прочитанные
        Chat::where('sender_id', $id)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $this->chats = Chat::where(function($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->senderId);
        })->orWhere(function($query) {
            $query->where('sender_id', $this->senderId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        $this->dispatch('chatUpdated');
        $this->dispatch('userSelected');
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:1000',
        ]);

        $chat = Chat::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $this->senderId,
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
        
        $data = [
            'message' => $this->message,
            'sender_id' => Auth::user()->id,
            'receiver_id' => $this->senderId,
            'created_at' => $chat->created_at,
        ];
        
        $pusher->trigger('message-sent', 'message-event', $data);

        // Добавляем диспетчеризацию события для обновления иконки
        $this->dispatch('message-sent', $data)->to('partials.message-icon');

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
            'echo-private:message-sent.message-event' => 'refreshMessages',
            'message-sent' => 'refreshMessages'
        ];
    }

    public function refreshMessages($data = null)
    {
        Log::info('Получено новое сообщение:', $data ?? []);
        
        $this->chats = Chat::where(function($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->senderId);
        })->orWhere(function($query) {
            $query->where('sender_id', $this->senderId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        $this->dispatch('chatUpdated');
    }
}
