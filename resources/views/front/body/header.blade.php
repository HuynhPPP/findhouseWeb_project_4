<header id="header-container" class="header head-tr">
    <!-- Header -->
    <div id="header" class="head-tr bottom">
        <div class="container container-header">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="{{ route('index') }}"><img src="{{ asset('front/images/logo-white-1.svg') }}"
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

            <!-- Right Side Content -->

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
            <div class="header-user-menu user-menu add">

                <div class="header-user-name">
                    @auth
                        <span>
                            @if ($profileData->role === 'poster')
                                <img src="{{ !empty($profileData->photo) ? url('upload/poster_images/' . $profileData->photo) : url('upload/no_img.jpg') }}"
                                    alt="">
                            @elseif ($profileData->role === 'user')
                                <img src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_img.jpg') }}"
                                    alt="">
                            @else
                                <img src="{{ url('upload/no_img.jpg') }}" alt="">
                            @endif
                        </span>
                        {{ $profileData->name }}
                    @else
                        <span><img src="{{ asset('upload/no_img.jpg') }}" alt=""></span>Tài khoản
                    @endauth
                </div>
                <ul>
                    @auth
                        @if (Auth::user()->role === 'poster')
                            <li><a href="{{ route('poster.dashboard') }}"> Tài khoản</a></li>
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
