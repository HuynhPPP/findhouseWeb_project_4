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
                <a class="active" href="dashboard.html">
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
                    <i class="fa fa-list" aria-hidden="true"></i>My Properties
                </a>
            </li>
            <li>
                <a href="favorited-listings.html">
                    <i class="fa fa-heart" aria-hidden="true"></i>Favorited Properties
                </a>
            </li>
            <li>
                <a href="add-property.html">
                    <i class="fa fa-list" aria-hidden="true"></i>Add Property
                </a>
            </li>
            <li>
                <a href="payment-method.html">
                    <i class="fas fa-credit-card"></i>Payments
                </a>
            </li>
            <li>
                <a href="invoice.html">
                    <i class="fas fa-paste"></i>Invoices
                </a>
            </li>
            <li>
                <a href="change-password.html">
                    <i class="fa fa-lock"></i>Change Password
                </a>
            </li>
            <li>
                <a href="index.html">
                    <i class="fas fa-sign-out-alt"></i>Log Out
                </a>
            </li>
        </ul>
    </div>
</div>