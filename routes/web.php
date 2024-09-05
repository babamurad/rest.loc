<?php

use App\Livewire\HomeComponent;
use App\Livewire\User\ForgotPasswordComponent;
use App\Livewire\User\LoginComponent;
use App\Livewire\User\LogoutComponent;
use App\Livewire\User\RegisterComponent;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeComponent::class)->name('home');

Route::get('register', RegisterComponent::class)->name('register');
Route::get('login', LoginComponent::class)->name('login');
Route::get('logout', LogoutComponent::class)->name('logout');
Route::get('forgot-password', ForgotPasswordComponent::class)->name('forgot-password');
