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

    #[On('avatar-changed')]
    #[On('order-created')]
    public function render()
    {
        $messages = OrderPlacedNotification::where('seen', 0)->latest()->take(5)->get();
        return view('livewire.admin.layouts.nav-bar-component', compact('messages'));
    }
}
