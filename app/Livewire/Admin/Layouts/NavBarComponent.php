<?php

namespace App\Livewire\Admin\Layouts;

use App\Models\Chat;
use App\Models\OrderPlacedNotification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class NavBarComponent extends Component
{
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        // return redirect()->route('/');
//        return $this->redirect('/login', navigate:true);
        return redirect()->route('login');
    }

    public function getFormattedDate($date)
    {
        // Исходная дата в формате ISO 8601
        $dateString = $date;

        // Создаем объект DateTime
        $date = new \DateTime($dateString);

        // Получаем текущую дату
        $now = new \DateTime();

        // Вычисляем разницу в секундах
        $interval = $date->diff($now);

        // Форматируем дату в зависимости от разницы
        if ($interval->days > 0) {
            return $interval->days . ' дн.' . ' назад';
        } elseif ($interval->h > 0) {
            return $interval->h . ' ч.' . ' назад';
        } elseif ($interval->i > 0) {
            return $interval->i . ' мин.' . ' назад';
        } else {
            return 'только что';
        }
    }

    public function markAllSeen()
    {
        $notification = OrderPlacedNotification::query()->update(['seen' => 1]);
        if ($notification) {
            toastr()->success('Все уведомления прочитаны');
        } else {
            toastr()->error('Не удалось прочитать уведомления');
        }
    }

    #[On('avatar-changed')]
    // #[On('order-created')]
    public function render()
    {
        $messages = OrderPlacedNotification::where('seen', 0)->latest()->take(15)->get();
        $chatUsers = User::where('id', '!=', Auth::user()->id)
            ->whereHas('chats', function($query) {
                $query->where('receiver_id', Auth::user()->id)
                      ->where('is_read', false);
            })
            ->withMax('chats', 'created_at')
            ->withCount(['chats as unread_messages' => function($query) {
                $query->where('receiver_id', Auth::user()->id)
                      ->where('is_read', false);
            }])
            ->orderByDesc('chats_max_created_at')
            ->get()
            ->map(function($user) {
                $user->is_online = $user->isOnline();
                return $user;
            });
        return view('livewire.admin.layouts.nav-bar-component', compact('messages', 'chatUsers'));
    }

    public function getListeners()
    {
        return [
            'refresh' => '$refresh'
        ];
    }
}
