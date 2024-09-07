<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class ChangePassword extends Component
{
    public $password;
    public $current_password;
    public $password_confirmation;

    protected function rules()
    {
        return  [
            'password' => 'required|min:6|confirmed',
            'current_password' => 'required|current_password',
        ];
    }

    public function render()
    {
        return view('livewire.dashboard.change-password');
    }

    public function updatePassword()
    {

        $this->validate();

        $user = User::FindOrFail(auth()->user()->id)->first();
        $user->update([
            'password' => $this->password,
        ]);
        flash()->success('User password has been updated!');
    }
}
