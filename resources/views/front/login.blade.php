<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from code-theme.com/html/findhouses/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Dec 2024 03:45:10 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="html 5 template">
    <meta name="author" content="">
    <title>Đăng nhập</title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome-5-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/styles.css') }}">
    <link rel="stylesheet" id="color" href="{{ asset('front/css/default.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/toastr/toastr.css') }}">
    <!-- End Toastr -->

    <style>
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 20px;
            display: block;
        }

        .input-error {
            border: 1px solid red;
            background-color: #ffe6e6;
            /* Nhẹ nhàng báo lỗi */
        }
    </style>
</head>

<body class="inner-pages hd-white">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- START SECTION HEADINGS -->
        <!-- Header Container
        ================================================== -->
        <div class="clearfix"></div>
        <!-- Header Container / End -->

        <section class="headings">
            <div class="text-heading text-center">
                <div class="container">
                    <h1>Đăng nhập</h1>
                    <h2><a href="{{ route('index') }}">Trang chủ </a> &nbsp;/&nbsp; đăng nhập</h2>
                </div>
            </div>
        </section>
        <!-- END SECTION HEADINGS -->

        <!-- START SECTION LOGIN -->
        <div id="login">
            <div class="login">
                <form name="registerform" id="loginForm">
                    @csrf
                    <div class="access_social">
                        <a href="{{ route('auth.google') }}" class="social_bt google">Đăng nhập bằng Google</a>
                    </div>
                    <div class="divider"><span>Hoặc</span></div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" type="email" id="email"
                            value="{{ old('email') }}">
                        <span id="email_error" class="error-message text-danger"></span>

                        <i class="icon_mail_alt"></i>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input class="form-control" name="password" id="password" type="password">
                        <span id="password_error" class="error-message"></span>

                        <i class="icon_lock_alt"></i>
                    </div>
                    <div class="fl-wrap filter-tags clearfix add_bottom_30">
                        <div class="float-right mt-1"><a id="forgot" href="{{ route('forget.password') }}">Quên
                                mật khẩu?</a></div>
                    </div>
                    <button type="submit" href="#0" class="btn_1 rounded full-width">Đăng nhập</button>
                    <div class="text-center add_top_10">Bạn chưa có tài khoản ? <strong><a
                                href="{{ route('register') }}">Đăng
                                ký!</a></strong></div>
                </form>
            </div>
        </div>
        <!-- END SECTION LOGIN -->

        <!-- START FOOTER -->
        @include('front.body.footer')

        <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
        <!-- END FOOTER -->


        <!-- ARCHIVES JS -->
        <script src="{{ asset('front/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('front/js/tether.min.js') }}"></script>
        <script src="{{ asset('front/js/popper.min.js') }}"></script>
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('front/js/mmenu.min.js') }}"></script>
        <script src="{{ asset('front/js/mmenu.js') }}"></script>
        <script src="{{ asset('front/js/smooth-scroll.min.js') }}"></script>
        <script src="{{ asset('front/js/ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('front/js/newsletter.js') }}"></script>
        <script src="{{ asset('front/js/color-switcher.js') }}"></script>
        <script src="{{ asset('front/js/inner.js') }}"></script>
        <script src="{{ asset('front/js/sweetalert2.js') }}"></script>

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

        @include('front.body.script')

    </div>
    <!-- Wrapper / End -->
</body>

</html>
