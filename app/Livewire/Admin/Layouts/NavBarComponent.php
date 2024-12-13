<?php

namespace App\Livewire\Admin\Layouts;

use App\Models\OrderPlacedNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class NavBarComponent extends Component
{
    public function logout(): null
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        // return redirect()->route('/');
//        return $this->redirect('/login', navigate:true);
        return $this->redirect('/login');
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
        return view('livewire.admin.layouts.nav-bar-component', compact('messages'));
    }
}
