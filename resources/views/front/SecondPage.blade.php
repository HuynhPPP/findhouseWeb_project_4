<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="html 5 template">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title')</title>
    
    <script>
        window.authId = {{ auth()->check() ? auth()->user()->id : 'null' }};
    </script>
    @vite(['resources/js/app.js'])
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/favicon.ico') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{ asset('front/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome-5-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/styles.css') }}">
    <link rel="stylesheet" id="color" href="{{ asset('front/css/default.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/toastr/toastr.css') }}">
    <!-- End Toastr -->
</head>

<body class="inner-pages st-1 agents hp-6 full hd-white">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- START PRELOADER -->
        <div id="preloader">
            <div id="status">
                <div class="status-mes"></div>
            </div>
        </div>
        <!-- END PRELOADER -->

        <!-- START SECTION HEADINGS -->
        <!-- Header Container
        ================================================== -->
        @include('front.body.header_2')
        <div class="clearfix"></div>
        <!-- Header Container / End -->

        @yield('home_2')

        <!-- START FOOTER -->
        @include('front.body.footer_2')


        <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
        <!-- END FOOTER -->

        <!-- Modal Login - Register -->
        @include('front.body.login_register')


        <!-- ARCHIVES JS -->
        <script src="{{ asset('front/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('front/js/rangeSlider.js') }}"></script>
        <script src="{{ asset('front/js/tether.min.js') }}"></script>
        <script src="{{ asset('front/js/popper.min.js') }}"></script>
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('front/js/mmenu.min.js') }}"></script>
        <script src="{{ asset('front/js/mmenu.js') }}"></script>
        <script src="{{ asset('front/js/aos.js') }}"></script>
        <script src="{{ asset('front/js/aos2.js') }}"></script>
        <script src="{{ asset('front/js/smooth-scroll.min.js') }}"></script>
        <script src="{{ asset('front/js/lightcase.js') }}"></script>
        <script src="{{ asset('front/js/search.js') }}"></script>
        <script src="{{ asset('front/js/light.js') }}"></script>
        <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('front/js/popup.js') }}"></script>
        <script src="{{ asset('front/js/searched.js') }}"></script>
        <script src="{{ asset('front/js/ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('front/js/newsletter.js') }}"></script>
        <script src="{{ asset('front/js/inner.js') }}"></script>
        <script src="{{ asset('front/js/color-switcher.js') }}"></script>
        <script src="{{ asset('front/js/sweetalert2.js') }}"></script>
        <script src="{{ asset('front/js/script.js') }}"></script>

        <script type="text/javascript" src="{{ asset('front/toastr/toastr.min.js') }}"></script>

        <!-- Sweetalert2 -->
        <script>
            @if (session('alert-type'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                });

                Toast.fire({
                    icon: '{{ session('alert-type') }}',
                    title: '{{ session('message') }}'
                });
            @endif
        </script>

        <script>
            $(".dropdown-filter").on('click', function() {

                $(".explore__form-checkbox-list").toggleClass("filter-block");

            });
        </script>
        @yield('customJs')

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() {
                    document.getElementById("preloader").style.display = "none";
                }, 1000); // Ẩn preloader sau 1 giây
            });
        </script>

        @include('front.body.script')


    </div>
    <!-- Wrapper / End -->
</body>

</html>
