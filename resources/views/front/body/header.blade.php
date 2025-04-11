<header id="header-container" class="header head-tr">
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
            @elseif ($profileData->role === 'user')
                <div class="right-side d-none d-none d-lg-none d-xl-flex">
                    <!-- Header Widget -->
                    <div class="header-widget">

                        <a href="{{ route('user.verification') }}" class="button border" style="width: 210px">
                            Bạn muốn đăng tin<i class="fas fa-laptop-house ml-2"></i>
                        </a>

                    </div>
                    <!-- Header Widget / End -->
                </div>
            @endif
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
                            <li>
                                <img src="{{ asset('front\images\setting.svg') }}" alt="">
                                <a href="{{ route('poster.dashboard') }}">Cài đặt tài khoản</a>
                            </li>
                        @else
                            <li>
                                <img src="{{ asset('front\images\setting.svg') }}" alt="">
                                <a href="{{ route('user.dashboard') }}">Cài đặt tài khoản</a>
                            </li>
                        @endif
                        <li>
                            <img src="{{ asset('front\images\menu-saved-ad.svg') }}" alt="">
                            <a href="{{ route('user.list.SavedPost') }}">Tin đăng đã lưu</a>
                        </li>
                        <li>
                            <img src="{{ asset('front\images\logout.svg') }}" alt="">
                            <a href="{{ route('logout') }}">Đăng xuất</a>
                        </li>
                    @else
                        <li class="show-reg-form modal-open">
                            <a href="javascript:void(0)"> Đăng nhập</a>
                        </li>

                        {{-- <li class="show-reg-form modal-open">
                            <a href="{{ route('register') }}"> Tạo tài khoản mới</a>
                        </li> --}}
                    @endauth

                </ul>
            </div>
            <!-- Right Side Content / End -->
        </div>
    </div>
</header>
