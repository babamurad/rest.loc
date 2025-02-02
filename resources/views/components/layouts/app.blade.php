<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />

    <title>{{ $title ?? 'Restaurant Template' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
        <!--jquery library js-->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.exzoom.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    @livewireStyles
    @stack('message')
    @stack('notif')
    @stack('mdb-css')
    @stack('scripts-pusher')


    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>

<!--=============================
    TOPBAR START
==============================-->
<section class="fp__topbar">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-8">
                <ul class="fp__topbar_info d-flex flex-wrap">
                    <li><a href="mailto:example@gmail.com"><i class="fas fa-envelope"></i> Unifood@gmail.com</a>
                    </li>
                    <li><a href="callto:123456789"><i class="fas fa-phone-alt"></i> +96487452145214</a></li>
                </ul>
            </div>
            <div class="col-xl-6 col-md-4 d-none d-md-block">
                <ul class="topbar_icon d-flex flex-wrap">
                    @guest
                        <li><a href="{{ route('login') }}" wire:navigate>{{ __('Login') }}</a></li>
                        <li><a href="{{ route('register') }}" wire:navigate>{{ __('Register') }}</a></li>
                    @endguest
                    @auth
                        @if(auth()->user()->role === 'admin')
                                <li><a href="{{ route('admin.dashboard') }}" wire:navigate>{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ route('dashboard') }}" wire:navigate>{{ __('User Dashboard') }}</a></li>
                        @else
                                <li><a href="{{ route('dashboard') }}" wire:navigate>{{ __('Dashboard') }}</a></li>
                        @endif
                        <livewire:user.logout-component />
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</section>
<!--=============================
    TOPBAR END
==============================-->


<!--=============================
    MENU START
==============================-->
{{--@livewire('partials.nav')--}}
<livewire:partials.nav />


<livewire:components.menu-cart />

<div class="fp__reservation">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Book a Table</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="fp__reservation_form">
                        <input class="reservation_input" type="text" placeholder="Name">
                        <input class="reservation_input" type="text" placeholder="Phone">
                        <input class="reservation_input" type="date">
                        <select class="reservation_input" id="select_js">
                            <option value="">select time</option>
                            <option value="">08.00 am to 09.00 am</option>
                            <option value="">10.00 am to 11.00 am</option>
                            <option value="">12.00 pm to 01.00 pm</option>
                            <option value="">02.00 pm to 03.00 pm</option>
                            <option value="">04.00 pm to 05.00 pm</option>
                        </select>
                        <select class="reservation_input" id="select_js2">
                            <option value="">select person</option>
                            <option value="">1 person</option>
                            <option value="">2 person</option>
                            <option value="">3 person</option>
                            <option value="">4 person</option>
                            <option value="">5 person</option>
                        </select>
                        <button type="submit">book table</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--=============================
    MENU END
==============================-->


{{ $slot }}


<!--=============================
    FOOTER START
==============================-->
@php
    use App\Models\FooterInfo;
    $footerInfo = FooterInfo::first();
@endphp
<footer>
    <div class="footer_overlay pt_100 xs_pt_70 pb_100 xs_pb_70">
        <div class="container wow fadeInUp" data-wow-duration="1s">
            <div class="row justify-content-between">
                <div class="col-lg-4 col-sm-8 col-md-6">
                    <div class="fp__footer_content">
                        <a class="footer_logo" href="/">
                            <img src="{{ asset( $footerInfo->logo ) }}" alt="FoodPark" class="img-fluid w-100">
                        </a>
                        @if(@$footerInfo->short_info)
                        <span>{{ $footerInfo->short_info }}</span>
                        @endif
                        @if(@$footerInfo->address)
                        <p class="info"><i class="far fa-map-marker-alt"></i> 7{{ $footerInfo->address }}</p>
                        @endif
                        @if(@$footerInfo->phone)
                        <a class="info" href="callto:1234567890123"><i class="fas fa-phone-alt"></i>{{ $footerInfo->phone }}</a>
                        @endif
                        @if(@$footerInfo->email)
                        <a class="info" href="mailto:websolutionus1@gmail.com"><i class="fas fa-envelope"></i>{{ $footerInfo->email }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-md-6">
                    <div class="fp__footer_content">
                        <h3>Short Link</h3>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Our Service</a></li>
                            <li><a href="#">gallery</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-md-6 order-sm-4 order-lg-3">
                    <div class="fp__footer_content">
                        <h3>Help Link</h3>
                        <ul>
                            <li><a href="#">Terms And Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-8 col-md-6 order-lg-4">
                    <div class="fp__footer_content">

                        <livewire:components.subscribe-component />

                        <div class="fp__footer_social_link">
                            <h5>follow us:</h5>
                            <ul class="d-flex flex-wrap">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fp__footer_bottom d-flex flex-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="fp__footer_bottom_text d-flex flex-wrap justify-content-between">
                        @if(@$footerInfo->copyright)
                        <p>{{ $footerInfo->copyright }}</p>
                        @endif
                        <ul class="d-flex flex-wrap">
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">payment</a></li>
                            <li><a href="#">settings</a></li>
                            <li><a href="#">privacy policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--=============================
    FOOTER END
==============================-->


<!--=============================
    SCROLL BUTTON START
==============================-->
<div class="fp__scroll_btn">
    go to top
</div>
<!--=============================
    SCROLL BUTTON END
==============================-->



<!--bootstrap js-->
{{-- <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script> --}}
<!--font-awesome js-->
<script src="{{ asset('assets/js/Font-Awesome.js') }}"></script>
<!-- slick slider -->
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<!-- isotop js -->
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
<!-- simplyCountdownjs -->
<script src="{{ asset('assets/js/simplyCountdown.js') }}"></script>
<!-- counter up js -->
{{-- <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/jquery.countup.min.js') }}"></script> --}}
<!-- nice select js -->
{{-- <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script> --}}
<!-- venobox js -->
<script src="{{ asset('assets/js/venobox.min.js') }}"></script>
<!-- sticky sidebar js -->
<script src="{{ asset('assets/js/sticky_sidebar.js') }}"></script>
<!-- wow js -->
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<!-- ex zoom js -->
<script src="{{ asset('assets/js/jquery.exzoom.js') }}"></script>

@livewireScripts
<!--main/custom js-->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    // toastr.options.progressBar = true;

{{--    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error('{{ $error }}');
    @endforeach
    @endif--}}

</script>

@stack('mdb-js')
@stack('modal')

</body>

</html>
