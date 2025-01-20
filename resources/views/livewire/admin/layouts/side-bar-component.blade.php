<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/" target="_blank">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/" target="_blank">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}" wire:navigate>
                <x-icons.dashboard />
                General Dashboard</a>
            </li>
            <li class="menu-header">Starter</li>
            <li  class="{{ request()->is('admin/slider') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.slider') }}" wire:navigate>
                    <x-icons.slider />
                    <span>Slider</span></a>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <x-icons.orders />
                     <span>{{ __('Orders') }}</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.orders.index') }}">{{__('All Orders')}}</a></li>
                    <li><a class="nav-link" href="#">Products</a></li>
                </ul>
            </li>

             <li class="dropdown">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <x-icons.resto />
                    <span>Manage Restaurant</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="nav-link" href="{{ route('admin.category.index') }}">Product Categories</a></li>
                     <li><a class="nav-link" href="{{ route('admin.product.index') }}">Products</a></li>
                 </ul>
             </li>
             <li class="dropdown">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <x-icons.ecom />
                    <span>Manage Ecommerce</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="nav-link" href="{{ route('admin.coupon') }}">{{__('Coupon')}}</a></li>
                     <li><a class="nav-link" href="{{ route('admin.delivery-area') }}">{{__('Delivery Area')}}</a></li>
                     <li><a class="nav-link" href="{{ route('admin.payment-settings') }}">{{__('Payment Gateways')}}</a></li>
                 </ul>
             </li>

            <li  class="{{ request()->is('admin/chat') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.chat') }}" wire:navigate><i class="fas fa-comments"></i> <span>Messages</span></a>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <x-icons.section />
                     <span>Sections</span></a>
                <ul class="dropdown-menu">
                    <li  class="{{ request()->is('admin/daily') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.daily') }}" wire:navigate>
                            <x-icons.offer />
                             <span>{{ __('Daily Offer') }}</span></a>
                    </li>
                    <li  class="{{ request()->is('admin/why-choose-us') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.why-choose-us') }}" wire:navigate>
                            <x-icons.choose />
                             <span>{{ __('Why choose us') }}</span></a>
                    </li>
                    <li  class="{{ request()->is('admin/banner') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.banner') }}" wire:navigate>
                            <x-icons.banner />
                             <span>{{ __('Banner') }}</span></a>
                    </li>
                    <li  class="{{ request()->is('admin/chef') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.chef') }}" wire:navigate>
                            <x-icons.chef />
                            <span>{{ __('Chefs') }}</span></a>
                    </li>
                </ul>
            </li>

            <li  class="{{ request()->is('admin/setting') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.setting') }}" wire:navigate><i class="fas fa-cogs"></i> <span>Settings</span></a>
            </li>

            {{-- <li class="dropdown">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                     <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                     <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                 </ul>
             </li>
             --}}

        </ul>

    </aside>
</div>
