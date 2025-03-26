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

    @vite(['resources/js/app.js'])
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
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
    <link rel="stylesheet" href="{{ asset('front/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/aos2.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/maps.css') }}">
    <link rel="stylesheet" href="{{ asset('front\css\popup_chat.css') }}">
    <link rel="stylesheet" id="color" href="{{ asset('front/css/colors/pink.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- End Toastr -->
</head>

<body class="homepage-9 hp-6 homepage-1 mh">

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
        @include('front.body.header')
        <div class="clearfix"></div>
        <!-- Header Container / End -->

        @yield('home')

        <!-- START FOOTER -->
        @include('front.body.footer')

        <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
        <!-- END FOOTER -->

        {{-- <!-- Popup nhắn tin -->
        <div id="messagePopup" class="message-popup">
            <div class="popup-header">
                <span>Nhắn tin</span>
                <button type="button" class="close-popup" onclick="closeMessagePopup()">×</button>
            </div>
            <div class="popup-body">
                <textarea placeholder="Nhập tin nhắn của bạn..." rows="4"></textarea>
            </div>
            <div class="popup-footer">
                <button type="button" class="send-btn" onclick="sendMessage()">Gửi</button>
            </div>
        </div> --}}
        <!-- Popup chat -->
        <div class="chat-popup" id="chatPopup">
            <!-- Tiêu đề popup -->
            <div class="chat-popup-header">
                <h5>Hộp thoại</h5>
                <button class="close-btn" onclick="closeChatPopup()">&times;</button>
            </div>
            <!-- Nội dung 2 cột -->
            <div class="chat-popup-body">
                <!-- Cột trái: Danh sách chat -->
                <div class="chat-list-col">
                    <!-- Thanh tìm kiếm -->
                    <div class="chat-search">
                        <input type="text" placeholder="Nhập ít nhất 3 ký tự để tìm...">
                    </div>
                    <!-- Danh sách cuộc hội thoại -->
                    <div class="chat-list">
                        <a href="javascript:void(0)" class="chat-list-item active">
                            <div class="user-info">
                                <img src="{{ asset('front\images\avt\avt1.jpg') }}" alt="avatar">
                                <div>
                                    <h6>Trường Giang</h6>
                                    <small>Hoạt động 2 ngày trước</small>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:void(0)" class="chat-list-item">
                            <div class="user-info">
                                <img src="{{ asset('front\images\avt\avt2.jpg') }}" alt="avatar">
                                <div>
                                    <h6>Quang Phạm</h6>
                                    <small>1 ngày trước</small>
                                </div>
                            </div>
                        </a>
                        <!-- Thêm các item khác nếu muốn -->
                    </div>
                </div>
                <!-- Cột phải: Khung chat chính -->
                <div class="chat-content-col">
                    <!-- Header khung chat -->
                    <div class="chat-content-header">
                        <img src="{{ asset('front\images\avt\avt3.jpg') }}" alt="avatar">
                        <div>
                            <h6>Trường Giang</h6>
                            <small>Hoạt động 2 ngày trước</small>
                        </div>
                    </div>
                    <!-- Nội dung tin nhắn -->
                    <div class="chat-messages">
                        <div class="message-bubble">
                            <p class="mb-1">
                                Phòng Trọ FULL NỘI THẤT Cao Cấp 25M2, công viên Hùng Vương 2.5tr
                            </p>
                            <span class="price">3 triệu/tháng</span>
                        </div>
                        <div class="message-bubble">
                            <p class="mb-1">Nội dung tin nhắn khác...</p>
                            <small class="text-muted">1 giờ trước</small>
                        </div>
                    </div>
                    <!-- Ô nhập tin nhắn -->
                    <div class="chat-input">
                        <div style="display: flex; align-items: center;">
                            <input type="text" class="chat-input-box" id="chatMessage"
                                placeholder="Nhập tin nhắn...">
                            <button class="send-btn" onclick="sendChatMessage()">
                                <i class="fa fa-paper-plane"></i> Gửi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nút kích hoạt popup (ví dụ: icon chat) -->
        <button id="openPopupBtn" class="open-popup-btn" onclick="openChatPopup()">
            <i class="fa fa-comment"></i>
        </button>



        <!-- ARCHIVES JS -->
        <script src="{{ asset('front/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('front/js/rangeSlider.js') }}"></script>
        <script src="{{ asset('front/js/tether.min.js') }}"></script>
        <script src="{{ asset('front/js/moment.js') }}"></script>
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('front/js/mmenu.min.js') }}"></script>
        <script src="{{ asset('front/js/mmenu.js') }}"></script>
        <script src="{{ asset('front/js/aos.js') }}"></script>
        <script src="{{ asset('front/js/aos2.js') }}"></script>
        <script src="{{ asset('front/js/animate.js') }}"></script>
        <script src="{{ asset('front/js/slick.min.js') }}"></script>
        <script src="{{ asset('front/js/fitvids.js') }}"></script>
        <script src="{{ asset('front/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('front/js/typed.min.js') }}"></script>
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
        <script src="{{ asset('front/js/forms-2.js') }}"></script>
        <script src="{{ asset('front/js/map-style2.js') }}"></script>

        <script src="{{ asset('front/js/range.js') }}"></script>
        <script src="{{ asset('front/js/color-switcher.js') }}"></script>
        <script>
            $(window).on('scroll load', function() {
                $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
            });
        </script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- Toast -->
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

        <!-- Slider Revolution scripts -->
        <script src="{{ asset('front/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
        <script src="{{ asset('front/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

        <script>
            var typed = new Typed('.typed', {
                strings: ["House ^2000", "Apartment ^2000", "Plaza ^4000"],
                smartBackspace: false,
                loop: true,
                showCursor: true,
                cursorChar: "|",
                typeSpeed: 50,
                backSpeed: 30,
                startDelay: 800
            });
        </script>

        <script>
            $('.slick-lancers').slick({
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
                adaptiveHeight: true,
                responsive: [{
                    breakpoint: 1292,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false
                    }
                }, {
                    breakpoint: 993,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false
                    }
                }, {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false
                    }
                }]
            });
        </script>

        <script>
            $('.job_clientSlide').owlCarousel({
                items: 2,
                loop: true,
                margin: 30,
                autoplay: false,
                nav: true,
                smartSpeed: 1000,
                slideSpeed: 1000,
                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    991: {
                        items: 3
                    }
                }
            });
        </script>

        <script>
            $('.style2').owlCarousel({
                loop: true,
                margin: 0,
                dots: false,
                autoWidth: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 2,
                        margin: 20
                    },
                    400: {
                        items: 2,
                        margin: 20
                    },
                    500: {
                        items: 3,
                        margin: 20
                    },
                    768: {
                        items: 4,
                        margin: 20
                    },
                    992: {
                        items: 5,
                        margin: 20
                    },
                    1000: {
                        items: 7,
                        margin: 20
                    }
                }
            });
        </script>

        <script>
            $(".dropdown-filter").on('click', function() {

                $(".explore__form-checkbox-list").toggleClass("filter-block");

            });
        </script>

        <!-- MAIN JS -->
        @yield('customJs')

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() {
                    document.getElementById("preloader").style.display = "none";
                }, 1000); // Ẩn preloader sau 1 giây
            });
        </script>

        <script>
            // Mở popup
            function openChatPopup() {
                document.getElementById('chatPopup').classList.add('active');
            }

            // Đóng popup (khi nhấn nút X)
            function closeChatPopup() {
                document.getElementById('chatPopup').classList.remove('active');
            }

            // Đóng popup (khi click nền mờ, trừ khi click vào chính popup)
            function closeChatPopupByOverlay(event) {
                // Nếu bấm bên ngoài popup, đóng
                const popup = document.getElementById('chatPopup');
                if (!popup.contains(event.target)) {
                    closeChatPopup();
                }
            }

            // Gửi tin nhắn
            function sendChatMessage() {
                const input = document.getElementById('chatMessage');
                const msg = input.value.trim();
                if (!msg) {
                    alert('Vui lòng nhập tin nhắn!');
                    return;
                }
                // Xử lý gửi tin nhắn ở đây (AJAX, v.v.)
                console.log('Tin nhắn:', msg);

                // Demo: thêm tin nhắn vào khung chat
                const chatMessages = document.querySelector('.chat-messages');
                const bubble = document.createElement('div');
                bubble.className = 'message-bubble';
                bubble.innerHTML = `<p>${msg}</p>`;
                chatMessages.appendChild(bubble);

                // Cuộn xuống cuối
                chatMessages.scrollTop = chatMessages.scrollHeight;

                // Reset input
                input.value = '';
            }
        </script>


    </div>
    <!-- Wrapper / End -->
</body>

</html>
