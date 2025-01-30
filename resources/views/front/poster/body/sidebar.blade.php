<div class="user-profile-box mb-0">
    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp

    <div class="sidebar-header"><a href="{{ route('index') }}"><img src="{{ asset('front/images/logo-blue.svg') }}" alt="header-logo2.png"> </a></div>
    <div class="header clearfix">
        <img src="{{ (!empty($profileData->photo)) ? url('front/upload/poster_images/'.$profileData->photo) : url('front/upload/no_img.jpg') }}" alt="avatar" class="img-fluid profile-img">
    </div>
    <div class="active-user">
        <h2>{{ $profileData->name }}</h2>
    </div>
    <div class="detail clearfix">
        <ul class="mb-0">
            <li>
                <a class="active" href="{{ route('poster.dashboard') }}">
                    <i class="fa fa-map-marker"></i> Trang thống kê
                </a>
            </li>
            <li>
                <a href="{{ route('poster.profile') }}">
                    <i class="fa fa-user"></i>Quản lý tài khoản
                </a>
            </li>
            <li>
                <a href="my-listings.html">
                    <i class="fa fa-list" aria-hidden="true"></i>Danh sách tin đăng
                </a>
            </li>
            <li>
                <a href="add-property.html">
                    <i class="fa fa-list" aria-hidden="true"></i>Đăng tin
                </a>
            </li>
            {{-- <li>
                <a href="payment-method.html">
                    <i class="fas fa-credit-card"></i>Payments
                </a>
            </li>
            <li>
                <a href="invoice.html">
                    <i class="fas fa-paste"></i>Invoices
                </a>
            </li> --}}
            <li>
                <a href="change-password.html">
                    <i class="fa fa-lock"></i>Xác minh tài khoản
                </a>
            </li>
            <li>
                <a href="{{ route('poster.change-password') }}">
                    <i class="fa fa-lock"></i>Đổi mật khẩu
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