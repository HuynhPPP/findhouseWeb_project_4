<div class="user-profile-box mb-0">
    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp

    <div class="sidebar-header"><a href="{{ route('index') }}"><img src="{{ asset('front/images/logo-blue.svg') }}"
                alt="header-logo2.png"> </a></div>
    <div class="header clearfix">
        <img src="{{ !empty($profileData->photo) && str_starts_with($profileData->photo, 'poster_')
            ? url('upload/user_images/' . $profileData->photo)
            : url('upload/no_img.jpg') }}"
            alt="avatar" class="img-fluid profile-img">
    </div>
    <div class="active-user">
        <h2>{{ $profileData->name }}</h2>
    </div>
    <div class="detail clearfix">
        <ul class="mb-0">
            <li>
                <a href="{{ route('poster.dashboard') }}"
                    class="{{ request()->routeIs('poster.dashboard') ? 'active' : '' }}">
                    <i class="fa fa-list"></i> Trang thống kê
                </a>
            </li>
            <li>
                <a href="{{ route('poster.profile') }}"
                    class="{{ request()->routeIs('poster.profile') ? 'active' : '' }}">
                    <i class="fa fa-user"></i>Quản lý tài khoản
                </a>
            </li>
            <li>
                <a href="{{ route('poster.post') }}" class="{{ request()->routeIs('poster.post') ? 'active' : '' }}">
                    <i class="fa fa-list" aria-hidden="true"></i>Đăng tin
                </a>
            </li>
            <li>
                <a href="{{ route('poster.list-post') }}"
                    class="{{ request()->routeIs('poster.list-post') ? 'active' : '' }}">
                    <i class="fa fa-list" aria-hidden="true"></i>Danh sách tin đăng
                </a>
            </li>
            
            <li>
                <a href="{{ route('poster.contacts') }}"
                    class="{{ request()->routeIs('poster.contacts') ? 'active' : '' }}">
                    <i class="fa fa-list" aria-hidden="true"></i>Danh sách liên hệ
                </a>
            </li>

            <li>
                <a href="{{ route('poster.review') }}"
                    class="{{ request()->routeIs('poster.review') ? 'active' : '' }}">
                    <i class="fas fa-comments" aria-hidden="true"></i>Danh sách đánh giá
                </a>
            </li>
            
            <li>
                <a href="{{ route('poster.list.SavedPost') }}"
                    class="{{ request()->routeIs('poster.list.SavedPost') ? 'active' : '' }}">
                    <i class="fa fa-heart" aria-hidden="true"></i>Tin đăng đã lưu
                </a>
            </li>
            @if (empty(auth()->user()->google_id) && (empty(auth()->user()->email_verified_at)))
                <li>
                    <a href="{{ route('poster.verification') }}"
                        class="{{ request()->routeIs('poster.verification') ? 'active' : '' }}">
                        <i class="fa fa-lock"></i> Xác minh tài khoản
                    </a>
                </li>
                
            @endif
            <li>
                <a href="{{ route('poster.change-password') }}"
                    class="{{ request()->routeIs('poster.change-password') ? 'active' : '' }}">
                    <i class="fa fa-lock"></i> Đổi mật khẩu
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt"></i>Đăng xuất
                </a>
            </li>
        </ul>
    </div>
</div>
