<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $title ?? 'General Dashboard' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/icon.ico') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
{{--    <link href="{{ asset('admin/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/summernote/summernote-bs4.css') }}">--}}

    @stack('toast-css')
    @stack('tab-css')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
    @stack('icon-css')
    @stack('alpine')
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>

        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
    @vite(['resources/js/app.js'])
</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>

        <livewire:admin.layouts.nav-bar-component />

        <livewire:admin.layouts.side-bar-component />

        <!-- Main Content -->
        <div class="main-content">
        {{ $slot }}
        </div>

        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2024 <div class="bullet"></div> Design By <a href="#">Charyyew Babamurad</a>
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
{{-- <script src="{{ asset('admin/assets/modules/moment.min.js') }}"></script> --}}
<script src="{{ asset('admin/assets/js/stisla.js') }}"></script>

@stack('scripts')
@stack('icon-js')
@stack('summernote-css')

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
    <script>
        // toastr.options.progressBar = true;
        // toastr.options.closeButton = true;

        toastr.options = {
            "closeButton": true, // Если нужно оставить кнопку закрытия
            "progressBar": true, // Если хотите прогресс-бар
            "positionClass": "toast-top-right", // Позиция уведомления
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "preventDuplicates": true // Предотвращает повторяющиеся уведомления
        };

        @if ($errors->any())
            @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}');
            @endforeach
        @endif
    </script>
@stack('summernote-js')
</body>
</html>
