<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterComponent extends Component
{
    public $name;
    public $email;
    public $password;
    public $agree;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ];

    protected $messages = [
        'name.required' => 'Имя обязательно для заполнения.',
        'name.string' => 'Имя должно быть строкой.',
        'name.max' => 'Имя не должно превышать 255 символов.',
        'email.required' => 'Email обязателен для заполнения.',
        'email.email' => 'Введите корректный Email адрес.',
        'email.unique' => 'Этот Email уже используется.',
        'password.required' => 'Пароль обязателен для заполнения.',
        'password.min' => 'Пароль должен содержать не менее 6 символов.',
        'password.confirmed' => 'Пароли не совпадают.',
    ];

    public function render()
    {
        return view('livewire.user.register-component');
    }

    public function registerUser()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->avatar = 'assets\admin\img\avatar\avatar-1.png';
        $user->password = Hash::make($this->password);
        $user->save();

        session()->flash('success', 'Successful registration');
        Auth::login($user);

        $this->redirectRoute('home');
    }
}
