<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>General Dashboard &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
{{--    <link href="{{ asset('admin/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/summernote/summernote-bs4.css') }}">--}}

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA --></head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{ asset('admin/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Logged in 5 min ago</div>
                        <a href="features-profile.html" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profile
                        </a>
                        <a href="features-activities.html" class="dropdown-item has-icon">
                            <i class="fas fa-bolt"></i> Activities
                        </a>
                        <a href="features-settings.html" class="dropdown-item has-icon">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <livewire:admin.layouts.side-bar-component />

        <!-- Main Content -->
        <div class="main-content">
        {{ $slot }}
        </div>

        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('admin/assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/popper.js') }}"></script>
<script src="{{ asset('admin/assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('admin/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
{{--<script src="{{ asset('admin/assets/modules/moment.min.js') }}"></script>--}}
<script src="{{ asset('admin/assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->
{{--<script src="{{ asset('admin/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/chart.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('admin/assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('admin/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>--}}

<!-- Page Specific JS File -->
{{--<script src="{{ asset('admin/assets/js/page/index-0.js') }}"></script>--}}

<!-- Template JS File -->
<script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
<script src="{{ asset('admin/assets/js/custom.js') }}"></script>
</body>
</html>
