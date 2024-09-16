<?php

use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminProfileComponent;
use App\Livewire\Admin\Category\CategoryIndexComponent;
use App\Livewire\Admin\Slider\CreateComponent;
use App\Livewire\Admin\Slider\EditSliderComponent;
use App\Livewire\Admin\Slider\SliderComponent;
use App\Livewire\Admin\WhyChooseUs\WhyChooseUsComponent;
use App\Livewire\Dashboard\ChangePassword;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\Profile;
use App\Livewire\HomeComponent;
use App\Livewire\Pages\About;
use App\Livewire\User\ForgotPasswordComponent;
use App\Livewire\User\LoginComponent;
use App\Livewire\User\LogoutComponent;
use App\Livewire\User\RegisterComponent;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeComponent::class)->name('home');
Route::get('about', About::class)->name('about');

Route::middleware('guest')->group(function () {
    Route::get('register', RegisterComponent::class)->name('register');
    Route::get('login', LoginComponent::class)->name('login');
    Route::get('logout', LogoutComponent::class)->name('logout');
    Route::get('forgot-password', ForgotPasswordComponent::class)->name('forgot-password');
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('profile', Profile::class)->name('profile');
    Route::get('change-password', ChangePassword::class)->name('change-password');
});


Route::middleware(['auth', 'admin:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('profile', AdminProfileComponent::class)->name('admin.profile');

    Route::get('slider', SliderComponent::class)->name('admin.slider');
    Route::get('slider/create', CreateComponent::class)->name('admin.slider.create');
    Route::get('slider/edit/{id}', EditSliderComponent::class)->name('admin.slider.edit');

    Route::get('why-choose-us', WhyChooseUsComponent::class)->name('admin.why-choose-us');
    Route::get('wcu-create', \App\Livewire\Admin\WhyChooseUs\CreateComponent::class)->name('admin.wcu-create');
    Route::get('wcu-edit/{id}', \App\Livewire\Admin\WhyChooseUs\EditComponent::class)->name('admin.wcu-edit');

    Route::get('category', CategoryIndexComponent::class)->name('admin.category.index');
});
