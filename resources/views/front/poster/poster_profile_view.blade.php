@extends('front.poster.poster_dashboard')
@section('poster')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="col-lg-6 col-md-6 col-xs-6 widget-boxed mt-33 mt-0 offset-lg-2 offset-md-3 mt-4">
    <div class="col-lg-12 mobile-dashbord dashbord">
        <div class="dashboard_navigationbar dashxl">
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10 mr-2"></i> Dashboard Navigation</button>
                <ul id="myDropdown" class="dropdown-content">
                    <li>
                        <a href="dashboard.html">
                            <i class="fa fa-map-marker mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="active" href="user-profile.html">
                            <i class="fa fa-user mr-3"></i>Profile
                        </a>
                    </li>
                    <li>
                        <a href="my-listings.html">
                            <i class="fa fa-list mr-3" aria-hidden="true"></i>My Properties
                        </a>
                    </li>
                    <li>
                        <a href="favorited-listings.html">
                            <i class="fa fa-heart mr-3" aria-hidden="true"></i>Favorited Properties
                        </a>
                    </li>
                    <li>
                        <a href="add-property.html">
                            <i class="fa fa-list mr-3" aria-hidden="true"></i>Add Property
                        </a>
                    </li>
                    <li>
                        <a href="payment-method.html">
                            <i class="fas fa-credit-card mr-3"></i>Payments
                        </a>
                    </li>
                    <li>
                        <a href="invoice.html">
                            <i class="fas fa-paste mr-3"></i>Invoices
                        </a>
                    </li>
                    <li>
                        <a href="change-password.html">
                            <i class="fa fa-lock mr-3"></i>Change Password
                        </a>
                    </li>
                    <li>
                        <a href="index.html">
                            <i class="fas fa-sign-out-alt mr-3"></i>Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="widget-boxed-header">
        <h4>Thông tin cá nhân</h4>
    </div>
    <div class="sidebar-widget author-widget2">
        <form name="contact_form" method="post" action="{{ route('poster.store.profile') }}" enctype="multipart/form-data">
            @csrf
            <div class="author-box clearfix">
                <img src="{{ (!empty($profileData->photo)) ? url('upload/poster_images/'.$profileData->photo) : url('upload/no_img.jpg') }}" 
                    alt="author-image" 
                    class="author__img"
                    id="showImage"
                >
                <h4 class="author__title">{{ $profileData->name }}</h4>
                <input type="file" id="image" name="photo" />
            </div>
        
            <ul class="author__contact">
                <li><span class="la la-phone"><i class="fa fa-phone" aria-hidden="true"></i></span><a href="#">(84) {{ $profileData->phone }}</a></li>
                <li><span class="la la-envelope-o"><i class="fa fa-envelope" aria-hidden="true"></i></span><a href="#">{{ $profileData->email }}</a></li>
            </ul>
            <div class="agent-contact-form-sidebar">
                <h4>Cập nhật thông tin</h4>
                <input type="text" id="fname" name="name" placeholder="Tên liên hệ" value="{{ $profileData->name }}" />
                <input type="number" id="pnumber" name="phone" placeholder="Số điện thoại" value="{{ $profileData->phone }}" />
                <input type="email" id="emailid" name="email" placeholder="Email" value="{{ $profileData->email }}" />
                <input type="submit" name="sendmessage" class="multiple-send-message" value="Xác nhận" />
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection