<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from code-theme.com/html/findhouses/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Dec 2024 03:45:07 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="html 5 template">
    <meta name="author" content="">
    <title>Find Houses</title>

    <script>
        window.authId = {{ auth()->user()->id }};
    </script>
    @vite(['resources/js/app.js'])
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/dashbord-mobile-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/styles.css') }}">
    <link rel="stylesheet" id="color" href="{{ asset('front/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('front/trumbowyg/trumbowyg.min.css') }}" />
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/toastr/toastr.css') }}">
    <!-- End Toastr -->
</head>

<body class="inner-pages maxw1600 m0a dashboard-bd">
    <!-- Wrapper -->
    <div id="wrapper" class="int_main_wraapper">
        <!-- START PRELOADER -->
        <div id="preloader-dashboard">
            <div id="progress-bar-dashboard"></div>
        </div>
        <!-- END PRELOADER -->

        <!-- START SECTION HEADINGS -->
        <!-- Header Container
        ================================================== -->
        @include('front.poster.body.header')
        <!-- Header Container / End -->

        <!-- START SECTION DASHBOARD -->
        <section class="user-page section-padding">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
                        @include('front.poster.body.sidebar')
                    </div>
                    @yield('poster')
                </div>
            </div>
        </section>
        <!-- END SECTION DASHBOARD -->
        {{-- @include('front.poster.body.footer') --}}
        <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
        <!-- END FOOTER -->


        <!-- START PRELOADER -->
        <div id="preloader">
            <div id="status">
                <div class="status-mes"></div>
            </div>
        </div>
        <!-- END PRELOADER -->

        <!-- ARCHIVES JS -->
        <script src="{{ asset('front/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('front/js/popper.min.js') }}"></script>
        <script src="{{ asset('front/js/jquery-ui.js') }}"></script>
        <script src="{{ asset('front/js/tether.min.js') }}"></script>
        <script src="{{ asset('front/js/moment.js') }}"></script>
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('front/js/mmenu.min.js') }}"></script>
        <script src="{{ asset('front/js/mmenu.js') }}"></script>
        <script src="{{ asset('front/js/swiper.min.js') }}"></script>
        <script src="{{ asset('front/js/swiper.js') }}"></script>
        <script src="{{ asset('front/js/slick.min.js') }}"></script>
        <script src="{{ asset('front/js/slick2.js') }}"></script>
        <script src="{{ asset('front/js/fitvids.js') }}"></script>
        <script src="{{ asset('front/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('front/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('front/js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('front/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('front/js/smooth-scroll.min.js') }}"></script>
        <script src="{{ asset('front/js/lightcase.js') }}"></script>
        <script src="{{ asset('front/js/search.js') }}"></script>
        <script src="{{ asset('front/js/owl.carousel.js') }}"></script>
        <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('front/js/ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('front/js/newsletter.js') }}"></script>
        <script src="{{ asset('front/js/jquery.form.js') }}"></script>
        <script src="{{ asset('front/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('front/js/searched.js') }}"></script>
        <script src="{{ asset('front/js/dashbord-mobile-menu.js') }}"></script>
        <script src="{{ asset('front/js/forms-2.js') }}"></script>
        <script src="{{ asset('front/js/color-switcher.js') }}"></script>
        <script src="{{ asset('front/trumbowyg/trumbowyg.min.js') }}"></script>
        <script src="{{ asset('front/js/sweetalert2.js') }}"></script>
        <script src="{{ asset('front/js/code.js') }}"></script>


        <script>
            $(".header-user-name").on("click", function() {
                $(".header-user-menu ul").toggleClass("hu-menu-vis");
                $(this).toggleClass("hu-menu-visdec");
            });
        </script>

        <!-- MAIN JS -->
        <script src="{{ asset('front/js/script.js') }}"></script>

        <script type="text/javascript" src="{{ asset('front/toastr/toastr.min.js') }}"></script>

        <script>
            @if (Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}"
                switch (type) {
                    case 'info':
                        toastr.info(" {{ Session::get('message') }} ");
                        break;

                    case 'success':
                        toastr.success(" {{ Session::get('message') }} ");
                        break;

                    case 'warning':
                        toastr.warning(" {{ Session::get('message') }} ");
                        break;

                    case 'error':
                        toastr.error(" {{ Session::get('message') }} ");
                        break;
                }
            @endif
        </script>

        <script>
            $(document).ready(function() {
                $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false
                });
            });
        </script>

        <script>
            $('.textarea').trumbowyg();
        </script>

        @yield('customJs')

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let progress = document.getElementById("progress-bar-dashboard");
                let width = 0;

                let interval = setInterval(function() {
                    width += 10; // Tăng tiến trình (có thể điều chỉnh)
                    progress.style.width = width + "%";

                    if (width >= 100) {
                        clearInterval(interval);
                        setTimeout(function() {
                            document.getElementById("preloader-dashboard").style.display = "none";
                        }, 300); // Chờ 300ms rồi ẩn thanh
                    }
                }, 100); // Cập nhật mỗi 100ms
            });
        </script>


    </div>
    <!-- Wrapper / End -->
</body>

</html>
