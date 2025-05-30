<nav class="navbar navbar-expand-lg main_menu">
    <div class="container" x-data="{ isOpen: false }">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/logo.png') }}" alt="FoodPark" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" @click="isOpen = !isOpen"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav"  :class="{ 'show': isOpen }">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}" wire:navigate>{{ __('About') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu') }}">{{ __('Menu') }}</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('chefs') }}">{{ __('Chefs') }}</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Pages') }} <i class="far fa-angle-down"></i></a>
                    <ul class="droap_menu">
                        <li><a href="{{ route('checkout') }}">{{ __('Checkout') }}</a></li>
                        <li><a href="{{ route('testimonial') }}">{{ __('Testimonial') }}</a></li>
                        <li><a href="{{ route('chefs') }}">{{ __('Chefs') }}</a></li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="blogs.html">{{ __('Blog') }}</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">{{ __('Contact') }}</a>
                </li>                
            </ul>
            <ul class="menu_icon d-flex flex-wrap">
                <li>
                    <a href="#" class="menu_search">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 50 50" fill="#000000">
                            <path
                                d="M21 3C11.601563 3 4 10.601563 4 20C4 29.398438 11.601563 37 21 37C24.355469 37 27.460938 36.015625 30.09375 34.34375L42.375 46.625L46.625 42.375L34.5 30.28125C36.679688 27.421875 38 23.878906 38 20C38 10.601563 30.398438 3 21 3 Z M 21 7C28.199219 7 34 12.800781 34 20C34 27.199219 28.199219 33 21 33C13.800781 33 8 27.199219 8 20C8 12.800781 13.800781 7 21 7Z"/>
                        </svg>

                    </a>
                    <div class="fp__search_form">
                        <form>
                            <span class="close_search"><i class="far fa-times"></i></span>
                            <input type="text" placeholder="Search . . .">
                            <button type="submit">search</button>
                        </form>
                    </div>
                </li>

                <livewire:partials.basket-icon />
                <livewire:partials.message-icon />
                
                <li>
                    @auth
                        <a href="{{ route('dashboard') }}" wire:navigate style="padding: 0% !important;"><i class="fas fa-user"></i></a>
                    @endauth

                    @guest
                        <a href="{{ route('register') }}" wire:navigate style="padding: 0% !important;"><i class="fas fa-user"></i></a>
                    @endguest

                </li> 
                {{-- {{-- <li><a class="lang-btn" href="#">tm</a></li> --}}
                {{-- <li><a class="lang-btn" href="#">ru</a></li>  --}}
                {{-- <li>
                    <a class="common_btn" href="#" data-bs-toggle="modal"
                       data-bs-target="#staticBackdrop">reservation</a>
                </li> --}}
            </ul>
        </div>
    </div>   
    
</nav>

