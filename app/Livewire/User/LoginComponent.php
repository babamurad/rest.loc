<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email;
    public $password;
    public $rememberMe = false;

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

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->rememberMe)) {
            $this->handleSuccessfulLogin();
        } else {
            flash()->error('Предоставленные учетные данные не соответствуют нашим записям.');
        }

        return;
    }

    private function handleSuccessfulLogin()
    {
        if(Auth::user()->role == 'admin') {
            return $this->redirect('/admin/dashboard');
        } elseif (Auth::user()->role == 'user') {
            return $this->redirect('/', navigate:true);
        } else {
            return redirect()->intended('/');
        }
    }

    public function render()
    {
        return view('livewire.user.login-component');
    }
}
