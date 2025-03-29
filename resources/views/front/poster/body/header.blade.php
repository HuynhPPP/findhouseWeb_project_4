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

                <div class="header-user-menu user-menu">
                    <div class="header-user-name">
                        <span>
                            <img src="{{ (!empty($profileData->photo)) ? url('upload/poster_images/'.$profileData->photo) : url('upload/no_img.jpg') }}" alt="">
                        </span>{{ $profileData->name }}
                    </div>
                    <ul>
                        <li><a href="user-profile.html"> Edit profile</a></li>
                        <li><a href="add-property.html"> Add Property</a></li>
                        <li><a href="payment-method.html">  Payments</a></li>
                        <li><a href="change-password.html"> Change Password</a></li>
                        <li><a href="{{ route('user.logout') }}">Log Out</a></li>
                    </ul>
                </div>
                <!-- Right Side Content / End -->
            </div>
        </div>
        <!-- Header / End -->
    </header>
</div>
<div class="clearfix"></div>