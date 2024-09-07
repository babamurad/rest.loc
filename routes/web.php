<?php

use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminProfileComponent;
use App\Livewire\Dashboard\ChangePassword;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\HomeComponent;
use App\Livewire\Pages\About;
use App\Livewire\User\ForgotPasswordComponent;
use App\Livewire\User\LoginComponent;
use App\Livewire\User\LogoutComponent;
use App\Livewire\User\RegisterComponent;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeComponent::class)->name('home');
Route::get('about', About::class)->name('about');

Route::get('register', RegisterComponent::class)->name('register');
Route::get('login', LoginComponent::class)->name('login');
Route::get('logout', LogoutComponent::class)->name('logout');
Route::get('forgot-password', ForgotPasswordComponent::class)->name('forgot-password');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});


Route::middleware(['admin:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('profile', AdminProfileComponent::class)->name('admin.profile');
    Route::get('change-password', ChangePassword::class)->name('change-password');
});
