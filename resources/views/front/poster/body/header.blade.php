<div class="dash-content-wrap">
    <header id="header-container" class="db-top-header">
        <!-- Header -->
        <div id="header">
            <div class="container-fluid">
                <!-- Left Side Content -->
                <div class="left-side">
                    <!-- Logo -->
                    <div id="logo">
                        <a href="index.html"><img src="{{ asset('front/images/logo.svg') }}" alt=""></a>
                    </div>
                    <!-- Mobile Navigation -->
                    <div class="mmenu-trigger">
                        <button class="hamburger hamburger--collapse" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                    <!-- Main Navigation -->
                    <nav id="navigation" class="style-1">
                        <ul id="responsive">
                            <li><a href="{{ route('index') }}">Trang chủ</a>

                        </ul>
                    </nav>
                    <div class="clearfix"></div>
                    <!-- Main Navigation / End -->
                </div>
                <!-- Left Side Content / End -->
                <!-- Right Side Content / -->

                @php
                    $id = Auth::user()->id;
                    $profileData = App\Models\User::find($id);
                @endphp

                @php
                    $userId = Auth::id();
                    $latestMessage = \App\Models\ChatMessage::where('receiver_id', $userId)->latest()->first();
                @endphp

                <div class="header-user-menu user-menu">
                    <div class="header-user-name">
                        <span>
                            <img src="{{ !empty($profileData->photo) && str_starts_with($profileData->photo, 'poster_')
                                ? url('upload/user_images/' . $profileData->photo)
                                : url('upload/no_img.jpg') }}"
                                alt="">
                        </span>{{ $profileData->name }}
                    </div>
                    <ul>
                        <li>
                            <a href="{{ route('user.logout') }}">
                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- <div class="header-user-menu user-menu">
                    <div class="header-user-name">
                        <i class="fa fa-bell"></i>
                    </div>
                    <ul>
                        <li>
                            <a href="">
                                <strong>Huỳnh Phan</strong>: Xin chào !
                                <br>
                                <small class="text-muted">19/4/2025</small>
                            </a>
                        </li>
                    </ul>
                </div> --}}
                <!-- Right Side Content / End -->
            </div>
        </div>
        <!-- Header / End -->
    </header>
</div>
<div class="clearfix"></div>
