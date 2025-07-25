<?php

use App\Livewire\Admin\AdminChatComponent;
use App\Livewire\Admin\AdminChatConversation;
use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminProfileComponent;
use App\Livewire\Admin\Category\CategoryCreateComponent;
use App\Livewire\Admin\Category\CategoryEditComponent;
use App\Livewire\Admin\Category\CategoryIndexComponent;
use App\Livewire\Admin\Coupon\CouponCreateComponent;
use App\Livewire\Admin\Coupon\CouponEditComponent;
use App\Livewire\Admin\Coupon\CouponIndexComponent;
use App\Livewire\Admin\DailyOffer\DailyOfferCreateComponent;
use App\Livewire\Admin\DailyOffer\DailyOfferEditComponent;
use App\Livewire\Admin\DailyOffer\DailyOfferIndexComponent;
use App\Livewire\Admin\Banner\BannerIndex;
use App\Livewire\Admin\Banner\BannerCreate;
use App\Livewire\Admin\Banner\BannerEdit;

use App\Livewire\Admin\Chef\ChefCreate;
use App\Livewire\Admin\Chef\ChefEdit;
use App\Livewire\Admin\Chef\ChefIndex;

use App\Livewire\Admin\Testimonial\TestimonialIndex;
use App\Livewire\Admin\Testimonial\TestimonialCreate;
use App\Livewire\Admin\Testimonial\TestimonialEdit;

use App\Livewire\Admin\Delivery\DeliveryAreaComponent;
use App\Livewire\Admin\Delivery\DeliveryAreaCreate;
use App\Livewire\Admin\Delivery\DeliveryAreaEdit;
use App\Livewire\Admin\Order\OrderIndexComponent;
use App\Livewire\Admin\Order\OrderViewComponent;
use App\Livewire\Admin\OrderComponent;
use App\Livewire\Admin\PaymentGatewaySettingComponent;
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
use App\Livewire\Dashboard\OrderComponent as UserOrders;
use App\Livewire\Dashboard\Profile;
use App\Livewire\HomeComponent;
use App\Livewire\Pages\About;
use App\Livewire\Pages\CartComponent;
use App\Livewire\Pages\ContactComponent;
use App\Livewire\Pages\CheckOutComponent;
use App\Livewire\PaymentComponent;
use App\Livewire\Dashboard\MessageComponent;
use App\Livewire\ProductDetails;
use App\Livewire\User\ForgotPasswordComponent;
use App\Livewire\User\LoginComponent;
use App\Livewire\User\LogoutComponent;
use App\Livewire\User\RegisterComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\TestComponent;
use App\Livewire\Pages\ChefPageComponent;
use App\Livewire\Pages\TestimonialPageComponent;
use App\Livewire\Admin\NewsLetterComponent;
use App\Livewire\Admin\FooterInfoComponent;
use App\Livewire\Pages\MenuComponent;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public routes
Route::get('/', HomeComponent::class)->name('home');
Route::get('about', About::class)->name('about');
Route::get('product-details/{slug}', ProductDetails::class)->name('product-details');
Route::get('cart', CartComponent::class)->name('cart');
Route::get('contact', ContactComponent::class)->name('contact');
Route::get('chefs', ChefPageComponent::class)->name('chefs');
Route::get('testimonial', TestimonialPageComponent::class)->name('testimonial');
Route::get('menu/{id?}', MenuComponent::class)->name('menu');


// Guest routes
Route::middleware('guest')->group(function () {
    // Registration route
    Route::get('register', RegisterComponent::class)->name('register');
    // Login route
    Route::get('login', LoginComponent::class)->name('login');

    // Forgot password route
    Route::get('forgot-password', ForgotPasswordComponent::class)->name('forgot-password');
});


// Authenticated user routes
Route::middleware(['auth', 'track-activity'])->group(function () {
    // Dashboard route
    Route::get('dashboard/{activeTab?}', Dashboard::class)->name('dashboard');
    // Profile route
    Route::get('profile', Profile::class)->name('profile');
    // Change password route
    Route::get('change-password', ChangePassword::class)->name('change-password');
    // Orders route
    Route::get('orders', UserOrders::class)->name('order.index');

    // Logout route
    Route::get('logout', LogoutComponent::class)->name('logout');
    // Checkout route
    Route::get('checkout', CheckOutComponent::class)->name('checkout');
    // Payment route
    Route::get('payment', PaymentComponent::class)->name('payment');

});


// Admin routes
Route::middleware(['auth', 'admin:admin', 'track-activity'])->prefix('admin')->group(function () {
    // Admin dashboard route
    Route::get('dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    // Admin profile route
    Route::get('profile', AdminProfileComponent::class)->name('admin.profile');

    // Slider routes
    Route::get('slider', SliderComponent::class)->name('admin.slider');
    Route::get('slider/create', CreateComponent::class)->name('admin.slider.create');
    Route::get('slider/edit/{id}', EditSliderComponent::class)->name('admin.slider.edit');

    // Daily offer routes
    Route::get('daily-offer', DailyOfferIndexComponent::class)->name('admin.daily');
    Route::get('daily-offer/create', DailyOfferCreateComponent::class)->name('admin.daily-offer.create');
    Route::get('daily-offer/edit/{id}', DailyOfferEditComponent::class)->name('admin.daily-offer.edit');

    // Banner routes
    Route::get('banner', BannerIndex::class)->name('admin.banner');
    Route::get('banner/create', BannerCreate::class)->name('admin.banner.create');
    Route::get('banner/edit/{id}', BannerEdit::class)->name('admin.banner.edit');

    // Chef routes
    Route::get('chef', ChefIndex::class)->name('admin.chef');
    Route::get('chef/create', ChefCreate::class)->name('admin.chef.create');
    Route::get('chef/edit/{id}', ChefEdit::class)->name('admin.chef.edit');

    // Testimonial routes
    Route::get('testimonial', TestimonialIndex::class)->name('admin.testimonial');
    Route::get('testimonial/create', TestimonialCreate::class)->name('admin.testimonial.create');
    Route::get('testimonial/edit/{id}', TestimonialEdit::class)->name('admin.testimonial.edit');

    // Newsletter route
    Route::get('newsletter', NewsLetterComponent::class)->name('admin.newsletter');
    
    // Footer info route
    Route::get('footer-info', FooterInfoComponent::class)->name('admin.footer-info');

    // Why choose us routes
    Route::get('why-choose-us', WhyChooseUsComponent::class)->name('admin.why-choose-us');
    Route::get('wcu-create', \App\Livewire\Admin\WhyChooseUs\CreateComponent::class)->name('admin.wcu-create');
    Route::get('wcu-edit/{id}', \App\Livewire\Admin\WhyChooseUs\EditComponent::class)->name('admin.wcu-edit');

    // Category routes
    Route::get('category', CategoryIndexComponent::class)->name('admin.category.index');
    Route::get('category/create', CategoryCreateComponent::class)->name('admin.category.create');
    Route::get('category/edit/{id}', CategoryEditComponent::class)->name('admin.category.edit');

    // Product routes
    Route::get('product', ProductIndexComponent::class)->name('admin.product.index');
    Route::get('product/create', ProductCreateComponent::class)->name('admin.product.create');
    Route::get('product/edit/{id}', ProductEditComponent::class)->name('admin.product.edit');

    // Setting route
    Route::get('setting', SettingComponent::class)->name('admin.setting');

    // Coupon routes
    Route::get('coupon', CouponIndexComponent::class)->name('admin.coupon');
    Route::get('coupon/create', CouponCreateComponent::class)->name('admin.coupon.create');
    Route::get('coupon/edit/{id}', CouponEditComponent::class)->name('admin.coupon.edit');

    // Delivery area routes
    Route::get('delivery-area', DeliveryAreaComponent::class)->name('admin.delivery-area');
    Route::get('delivery-area/create', DeliveryAreaCreate::class)->name('admin.delivery-area.create');
    Route::get('delivery-area/edit/{id}', DeliveryAreaEdit::class)->name('admin.delivery-area.edit');

    // Chat routes
    Route::get('chat/{id?}', AdminChatComponent::class)->name('admin.chat');
    Route::get('chat/user/{id}', AdminChatConversation::class)->name('admin.chat.user');

    // Payment settings route
    Route::get('payment-settings', PaymentGatewaySettingComponent::class)->name('admin.payment-settings');

    // Orders routes
    Route::get('orders', OrderIndexComponent::class)->name('admin.orders.index');
    Route::get('orders/{id}', OrderViewComponent::class)->name('admin.orders.show');

    // Test route
    Route::get('test', TestComponent::class)->name('admin.test');

});

date_default_timezone_set("Asia/Ashgabat");
