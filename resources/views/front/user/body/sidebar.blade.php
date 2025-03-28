<div class="user-profile-box mb-0">
    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp

    <div class="sidebar-header"><a href="{{ route('index') }}"><img src="{{ asset('front/images/logo-blue.svg') }}"
                alt="header-logo2.png"> </a></div>
    <div class="header clearfix">
        <img src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_img.jpg') }}"
            alt="avatar" class="img-fluid profile-img">
    </div>
    <div class="active-user">
        <h2>{{ $profileData->name }}</h2>
    </div>
    <div class="detail clearfix">
        <ul class="mb-0">
            <li>
                <a href="{{ route('user.dashboard') }}"
                    class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <i class="fa fa-list"></i> Trang thống kê
                </a>
            </li>
            <li>
                <a href="{{ route('user.profile') }}" class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                    <i class="fa fa-user"></i>Quản lý tài khoản
                </a>
            </li>
            <li>
                <a href="{{ route('user.contacts') }}">
                    <i class="fa fa-list" aria-hidden="true"></i>Danh sách liên hệ
                </a>
            </li>
            <li>
                <a href="favorited-listings.html">
                    <i class="fa fa-heart" aria-hidden="true"></i>Bài đăng yêu thích
                </a>
            </li>
            <li>
                <a href="change-password.html">
                    <i class="fa fa-lock"></i>Đổi mật khẩu
                </a>
            </li>
            <li>
                <a href="index.html">
                    <i class="fas fa-sign-out-alt"></i>Đăng xuất
                </a>
            </li>
        </ul>
    </div>
</div>
