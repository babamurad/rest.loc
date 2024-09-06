<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />

    <title>FoodPark || Restaurant Template</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.exzoom.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

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
                        <li><a href="{{ route('login') }}" wire:navigate>Login</a></li>
                        <li><a href="{{ route('register') }}" wire:navigate>Register</a></li>
                    @endguest
                    @auth
                        @if(auth()->user()->role === 'admin')
                                <li><a href="{{ route('admin.dashboard') }}" wire:navigate>Dashboard</a></li>
                                <li><a href="{{ route('dashboard') }}" wire:navigate>User Dashboard</a></li>
                        @else
                                <li><a href="{{ route('dashboard') }}" wire:navigate>Dashboard</a></li>
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


<div class="fp__menu_cart_area">
    <div class="fp__menu_cart_boody">
        <div class="fp__menu_cart_header">
            <h5>total item (05)</h5>
            <span class="close_cart"><i class="fal fa-times"></i></span>
        </div>
        <ul>
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset('assets/images/menu8.png') }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Hyderabadi Biryani </a>
                    <p class="size">small</p>
                    <span class="extra">coca-cola</span>
                    <span class="extra">7up</span>
                    <p class="price">$99.00 <del>$110.00</del></p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li>
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset('assets/images/menu4.png') }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Chicken Masalas</a>
                    <p class="size">medium</p>
                    <span class="extra">7up</span>
                    <p class="price">$70.00</p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li>
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset('assets/images/menu5.png') }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Competently Supply Customized Initiatives</a>
                    <p class="size">large</p>
                    <span class="extra">coca-cola</span>
                    <span class="extra">7up</span>
                    <p class="price">$120.00 <del>$150.00</del></p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li>
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset('assets/images/menu6.png') }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Hyderabadi Biryani</a>
                    <p class="size">small</p>
                    <span class="extra">7up</span>
                    <p class="price">$59.00</p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li>
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset('assets/images/menu1.png') }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Competently Supply</a>
                    <p class="size">medium</p>
                    <span class="extra">coca-cola</span>
                    <span class="extra">7up</span>
                    <p class="price">$99.00 <del>$110.00</del></p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li>
        </ul>
        <p class="subtotal">sub total <span>$1220.00</span></p>
        <a class="cart_view" href="cart_view.html"> view cart</a>
        <a class="checkout" href="check_out.html">checkout</a>
    </div>
</div>

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
<footer>
    <div class="footer_overlay pt_100 xs_pt_70 pb_100 xs_pb_70">
        <div class="container wow fadeInUp" data-wow-duration="1s">
            <div class="row justify-content-between">
                <div class="col-lg-4 col-sm-8 col-md-6">
                    <div class="fp__footer_content">
                        <a class="footer_logo" href="/">
                            <img src="{{ asset('assets/images/footer_logo.png') }}" alt="FoodPark" class="img-fluid w-100">
                        </a>
                        <span>There are many variations of Lorem Ipsum available, but the majority have suffered.</span>
                        <p class="info"><i class="far fa-map-marker-alt"></i> 7232 Broadway Suite 308, Jackson
                            Heights, 11372, NY, United States</p>
                        <a class="info" href="callto:1234567890123"><i class="fas fa-phone-alt"></i>
                            +1347-430-9510</a>
                        <a class="info" href="mailto:websolutionus1@gmail.com"><i class="fas fa-envelope"></i>
                            websolutionus1@gmail.com</a>
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
                        <h3>subscribe</h3>
                        <form>
                            <input type="text" placeholder="Subscribe">
                            <button>Subscribe</button>
                        </form>
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
                        <p>Copyright 2022 <b>FoodPark</b> All Rights Reserved.</p>
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


<!--jquery library js-->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<!--bootstrap js-->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!--font-awesome js-->
<script src="{{ asset('assets/js/Font-Awesome.js') }}"></script>
<!-- slick slider -->
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<!-- isotop js -->
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
<!-- simplyCountdownjs -->
<script src="{{ asset('assets/js/simplyCountdown.js') }}"></script>
<!-- counter up js -->
<script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countup.min.js') }}"></script>
<!-- nice select js -->
<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
<!-- venobox js -->
<script src="{{ asset('assets/js/venobox.min.js') }}"></script>
<!-- sticky sidebar js -->
<script src="{{ asset('assets/js/sticky_sidebar.js') }}"></script>
<!-- wow js -->
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<!-- ex zoom js -->
<script src="{{ asset('assets/js/jquery.exzoom.js') }}"></script>

<!--main/custom js-->
<script src="{{ asset('assets/js/main.js') }}"></script>


</body>

</html>
