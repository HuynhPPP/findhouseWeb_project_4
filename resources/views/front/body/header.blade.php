<header id="header-container" class="header head-tr">
    <!-- Header -->
    <div id="header" class="head-tr bottom">
        <div class="container container-header">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="index.html"><img src="{{ asset('front/images/logo-white-1.svg') }}" data-sticky-logo="{{ asset('front/images/logo-red.svg') }}" alt=""></a>
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
            <div class="right-side d-none d-none d-lg-none d-xl-flex">
                <!-- Header Widget -->
                <div class="header-widget">
                    @if(Auth::guest())

                    @else
                    <a href="{{ route('poster.post') }}" class="button border">Đăng tin<i class="fas fa-laptop-house ml-2"></i></a>
                    @endif
                </div>
                <!-- Header Widget / End -->
            </div>
            <!-- Right Side Content / End -->
            <!-- Right Side Content / End -->
            <div class="header-user-menu user-menu add">
                @php
                    $profileData = Auth::check() ? App\Models\User::find(Auth::user()->id) : null;
                @endphp
                <div class="header-user-name">
                    @auth
                        <span>
                            @if ($profileData->role === 'poster')
                                <img src="{{ (!empty($profileData->photo)) ? url('front/upload/poster_images/'.$profileData->photo) : url('front/upload/no_img.jpg') }}" alt="">
                            @elseif ($profileData->role === 'user')
                                <img src="{{ (!empty($profileData->photo)) ? url('front/upload/user_images/'.$profileData->photo) : url('front/upload/no_img.jpg') }}" alt="">
                            @else
                                <img src="{{ url('front/upload/no_img.jpg') }}" alt="">
                            @endif
                        </span>
                        {{ $profileData->name }}
                    @else
                        <span><img src="{{ asset('front/upload/no_img.jpg') }}" alt=""></span>Tài khoản
                    @endauth
                </div>
                <ul>
                    @auth
                        @if(Auth::user()->role === 'poster')
                            <li><a href="{{ route('poster.profile') }}"> Quản lý tài khoản</a></li>
                        @else
                            <li><a href="{{ route('user.dashboard') }}"> Quản lý tài khoản</a></li>
                        @endif
                        
                        <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                    @else
                        <li class="show-reg-form modal-open">
                            <a href="user-profile.html"> Đăng nhập</a>
                        </li>

                        <li class="show-reg-form modal-open">
                            <a href="user-profile.html"> Tạo tài khoản mới</a>
                        </li>
                    @endauth
                    
                </ul>
            </div>
            <!-- Right Side Content / End -->

            <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                <!-- Header Widget -->
                
                <!-- Header Widget / End -->
            </div>
            <!-- Right Side Content / End -->

            

        </div>
    </div>
    <!-- Header / End -->

</header>