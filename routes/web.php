<?php

use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminProfileComponent;
use App\Livewire\Admin\Category\CategoryCreateComponent;
use App\Livewire\Admin\Category\CategoryEditComponent;
use App\Livewire\Admin\Category\CategoryIndexComponent;
use App\Livewire\Admin\Coupon\CouponCreateComponent;
use App\Livewire\Admin\Coupon\CouponEditComponent;
use App\Livewire\Admin\Coupon\CouponIndexComponent;
use App\Livewire\Admin\Product\ProductCreateComponent;
use App\Livewire\Admin\Product\ProductEditComponent;
use App\Livewire\Admin\Product\ProductIndexComponent;
use App\Livewire\Admin\SettingComponent;
use App\Livewire\Admin\Slider\CreateComponent;
use App\Livewire\Admin\Slider\EditSliderComponent;
use App\Livewire\Admin\Slider\SliderComponent;
use App\Livewire\Admin\WhyChooseUs\WhyChooseUsComponent;
use App\Livewire\Dashboard\ChangePassword;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\Profile;
use App\Livewire\HomeComponent;
use App\Livewire\Pages\About;
use App\Livewire\Pages\CartComponent;
use App\Livewire\Pages\CheckOutComponent;
use App\Livewire\ProductDetails;
use App\Livewire\User\ForgotPasswordComponent;
use App\Livewire\User\LoginComponent;
use App\Livewire\User\LogoutComponent;
use App\Livewire\User\RegisterComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\TestComponent;


Route::get('/', HomeComponent::class)->name('home');
Route::get('about', About::class)->name('about');
Route::get('product-details/{slug}', ProductDetails::class)->name('product-details');
Route::get('cart', CartComponent::class)->name('cart');


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

    Route::get('checkout', CheckOutComponent::class)->name('checkout');
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
    Route::get('category/create', CategoryCreateComponent::class)->name('admin.category.create');
    Route::get('category/edit/{id}', CategoryEditComponent::class)->name('admin.category.edit');

    Route::get('product', ProductIndexComponent::class)->name('admin.product.index');
    Route::get('product/create', ProductCreateComponent::class)->name('admin.product.create');
    Route::get('product/edit/{id}', ProductEditComponent::class)->name('admin.product.edit');

    Route::get('setting', SettingComponent::class)->name('admin.setting');

    Route::get('coupon', CouponIndexComponent::class)->name('admin.coupon');
    Route::get('coupon/create', CouponCreateComponent::class)->name('admin.coupon.create');
    Route::get('coupon/edit/{id}', CouponEditComponent::class)->name('admin.coupon.edit');

    Route::get('test', TestComponent::class)->name('admin.test');
});
