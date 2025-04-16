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
        body {
            height: 100vh;
            font-family: 'Arial', sans-serif;
            background-color: #fdf5ed;
        }

        .card {
            width: 550px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
        }

        .btn-danger {
            border-radius: 6px;
            font-size: 18px;
            background-color: #dc3545;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        #email {
            height: 50px;
            border-radius: 6px;
        }

        .loading-container {
            display: none;
            text-align: center;
            margin-top: 15px;
        }

        .loading-container .spinner-border {
            width: 2rem;
            height: 2rem;
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
                    <h1>Quên mật khẩu</h1>
                    <h2><a href="{{ route('index') }}">Trang chủ </a> &nbsp;/&nbsp; đăng nhập</h2>
                </div>
            </div>
        </section>
        <!-- END SECTION HEADINGS -->

        <!-- START SECTION LOGIN -->
        <div class="d-flex justify-content-center align-items-center">
            <div class="card p-4">
                <h3 class="text-center font-weight-bold">Đặt lại mật khẩu</h3>
                <p class="text-center text-muted">Nhập Email của bạn để nhận mã đặt lại mật khẩu</p>

                <form method="POST" action="{{ route('confirm.password.code') }}" id="forgetPassForm">
                    @csrf
                    <div class="form-group">
                        <label for="phone">Email</label>
                        <input type="text" id="email" name="email" class="form-control"
                            value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <button type="submit" id="submitBtnForget"
                        class="btn btn-block btn-danger py-2 font-weight-bold">Tiếp
                        tục →</button>

                    <!-- Thông báo đang xử lý -->
                    <div id="loadingMessageForget" class="text-center mt-3" style="display: none;">
                        <div class="spinner-border text-danger" role="status">
                            <span class="sr-only">Đang xử lý...</span>
                        </div>
                        <p class="text-muted">Đang xử lý yêu cầu, vui lòng đợi...</p>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SECTION LOGIN -->

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
            document.getElementById("forgetPassForm").addEventListener("submit", function() {
                // Ẩn nút bấm
                document.getElementById("submitBtnForget").style.display = "none";

                // Hiển thị thông báo "Đang xử lý..."
                document.getElementById("loadingMessageForget").style.display = "block";
            });
        </script>

    </div>
    <!-- Wrapper / End -->
</body>

</html>
