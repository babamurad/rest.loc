<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AdminProfileComponent extends Component
{
    public $name;
    public $email;

    public $password;
    public $current_password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|max:200|unique:users,email,' . auth()->user()->id,
        ];
    }

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function updateUser()
    {
        $validated = $this->validate();
        $user = User::FindOrFail(auth()->user()->id)->first();
        $user->update($validated);
        session()->flash('success', 'User name and email has been updated!');
//        $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Your data has been saved successfully!']);
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:6|confirmed',
            'current_password' => 'required|current_password',
        ]);

        $user = User::FindOrFail(auth()->user()->id)->first();
        $user->update([
            'password' => $this->password,
        ]);
        session()->flash('success', 'User password has been updated!');
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.admin-profile-component');
    }
}
