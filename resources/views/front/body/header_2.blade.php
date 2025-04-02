<header id="header-container">
    <!-- Header -->
    <div id="header">
        <div class="container container-header">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="{{ route('index') }}"><img src="{{ asset('front/images/logo-red.svg') }}"
                            data-sticky-logo="{{ asset('front/images/logo-red.svg') }}" alt=""></a>
                </div>
                <!-- Mobile Navigation -->
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <!-- Left Side Content / End -->

            <!-- Right Side Content / End -->
            @php
                $profileData = Auth::check() ? App\Models\User::find(Auth::user()->id) : null;
            @endphp
            @if (Auth::guest())
            @elseif ($profileData->role === 'poster')
                <div class="right-side d-none d-none d-lg-none d-xl-flex">
                    <!-- Header Widget -->
                    <div class="header-widget">

                        <a href="{{ route('poster.post') }}" class="button border">Đăng tin<i
                                class="fas fa-laptop-house ml-2"></i></a>

                    </div>
                    <!-- Header Widget / End -->
                </div>
            @endif
            <!-- Right Side Content / End -->
            <!-- Right Side Content / End -->
            <div class="header-user-menu user-menu add">

                <div class="header-user-name">
                    @auth
                        <span>
                            @php
                                $defaultImage = url('upload/no_img.jpg');
                                $imagePath = $defaultImage;

                                if (!empty($profileData->photo)) {
                                    if (str_contains($profileData->photo, 'poster_')) {
                                        $imagePath = url('upload/user_images/' . $profileData->photo);
                                    } elseif (str_contains($profileData->photo, 'user_')) {
                                        $imagePath = url('upload/user_images/' . $profileData->photo);
                                    }
                                }
                            @endphp

                            <img src="{{ $imagePath }}" alt="">
                        </span>
                        {{ $profileData->name }}
                    @else
                        <span><img src="{{ asset('upload/no_img.jpg') }}" alt=""></span>Tài khoản
                    @endauth
                </div>
                <ul>
                    @auth
                        @if (Auth::user()->role === 'poster')
                            <li><a href="{{ route('poster.profile') }}"> Tài khoản</a></li>
                        @else
                            <li><a href="{{ route('user.dashboard') }}"> Tài khoản</a></li>
                        @endif

                        <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                    @else
                        <li class="">
                            <a href="{{ route('login') }}"> Đăng nhập</a>
                        </li>

                        <li class="">
                            <a href="{{ route('register') }}"> Tạo tài khoản mới</a>
                        </li>
                    @endauth

                </ul>
            </div>
            <!-- Right Side Content / End -->

            <!-- Right Side Content / End -->



        </div>
    </div>
    <!-- Header / End -->

</header>
