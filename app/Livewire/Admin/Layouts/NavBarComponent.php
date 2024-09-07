<?php

namespace App\Livewire\Admin\Layouts;

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
        return $this->redirect('/login');
    }

    #[On('avatar-changed')]
    public function render()
    {
        return view('livewire.admin.layouts.nav-bar-component');
    }
}
