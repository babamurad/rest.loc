<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email|max:255|exists:users,email',
        'password' => 'required|string|min:6',
    ];

    protected $messages = [
        'email.required' => 'Email обязателен для заполнения.',
        'email.email' => 'Введите корректный Email адрес.',
        'email.unique' => 'Этот Email уже используется.',
        'password.required' => 'Пароль обязателен для заполнения.',
        'password.min' => 'Пароль должен содержать не менее 6 символов.',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {

            // Redirect or do something after successful login
            if(Auth::user()->role == 'admin') {
                return $this->redirect('/', navigate:true);
            } elseif (Auth::user()->role == 'user') {
                return $this->redirect('/', navigate:true);
            } else {
                return redirect()->intended('/');
            }

        } else {
            $this->addError('email', 'The provided credentials do not match our records.');
        }
    }

    public function render()
    {
        return view('livewire.user.login-component');
    }
}
