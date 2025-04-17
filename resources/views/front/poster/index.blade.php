@extends('front.poster.poster_dashboard')
@section('poster')
    <style>
        .status-select {
            width: 100%;
            /* Hoặc width: auto nếu muốn giữ theo nội dung */
            max-width: 150px;
            /* Giới hạn chiều rộng */
            height: 30px;
            /* Giảm chiều cao */
            padding: 2px 25px;
            margin-top: 13px;
            font-size: 14px;
        }

        .table td {
            align-content: center;
        }

        .table-responsive-2{
            display: block;
            width: 100%;
            -webkit-overflow-scrolling: touch;
        }
    </style>

    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
        <div class="col-lg-12 mobile-dashbord dashbord">
            <div class="dashboard_navigationbar dashxl">
                <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10 mr-2"></i> Dashboard
                        Navigation</button>
                    <ul id="myDropdown" class="dropdown-content">
                        <li>
                            <a class="active" href="dashboard.html">
                                <i class="fa fa-map-marker mr-3"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="user-profile.html">
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
        <div class="dashborad-box stat bg-white">
            <h4 class="title">Manage Dashboard</h4>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-xs-12 dar pro mr-3">
                        <div class="item">
                            <div class="icon">
                                <i class="fa fa-list" aria-hidden="true"></i>
                            </div>
                            <div class="info">
                                <h6 class="number">345</h6>
                                <p class="type ml-1">Published Property</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-xs-12 dar rev mr-3">
                        <div class="item">
                            <div class="icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="info">
                                <h6 class="number">116</h6>
                                <p class="type ml-1">Total Reviews</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 dar com mr-3">
                        <div class="item mb-0">
                            <div class="icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <div class="info">
                                <h6 class="number">223</h6>
                                <p class="type ml-1">Messages</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 dar booked">
                        <div class="item mb-0">
                            <div class="icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="info">
                                <h6 class="number">432</h6>
                                <p class="type ml-1">Times Bookmarked</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- <div class="dashborad-box">
            <div class="row no-gutters chat-container">
                <!-- DANH SÁCH CHAT BÊN TRÁI -->
                <div class="col-12 col-md-4 col-lg-3 border-right chat-list">
                    <div class="chat-list-header p-3 border-bottom">
                        <h5 class="mb-0">Tin nhắn</h5>
                    </div>
                    <div class="chat-list-body p-3">
                        <h5 class="mb-4">Danh sách người gửi yêu cầu</h5>
                        <!-- Danh sách các user, group, v.v. -->
                        <div class="chat-user d-flex align-items-center mb-3">
                            <img src="images/testimonials/ts-1.jpg" alt="Avatar"
                                class="rounded-circle mr-2 chat-user-img">
                            <div>
                                <div class="chat-user-name">Rachel Zane</div>
                                <div class="chat-user-last-msg text-muted small">Hi, how are you?</div>
                            </div>
                        </div>
                        <div class="chat-user d-flex align-items-center mb-3 active">
                            <img src="images/testimonials/ts-2.jpg" alt="Avatar"
                                class="rounded-circle mr-2 chat-user-img">
                            <div>
                                <div class="chat-user-name">Harvey Inspector</div>
                                <div class="chat-user-last-msg text-muted small">Where are you now?</div>
                            </div>
                        </div>
                        <div class="chat-user d-flex align-items-center mb-3">
                            <img src="images/testimonials/ts-3.jpg" alt="Avatar"
                                class="rounded-circle mr-2 chat-user-img">
                            <div>
                                <div class="chat-user-name">Donna Paulsen</div>
                                <div class="chat-user-last-msg text-muted small">Meeting tomorrow</div>
                            </div>
                        </div>
                        <!-- Thêm các user khác ... -->
                    </div>
                </div>
                <!-- /DANH SÁCH CHAT BÊN TRÁI -->

                <!-- KHUNG CHAT BÊN PHẢI -->
                <div class="col-12 col-md-8 col-lg-9 d-flex flex-column">
                    <div class="chat-header d-flex align-items-center p-3 border-bottom">
                        <img src="images/testimonials/ts-2.jpg" alt="Avatar" class="rounded-circle mr-2 chat-user-img">
                        <div>
                            <h6 class="mb-0">Harvey Inspector</h6>
                        </div>
                    </div>

                    <!-- Nội dung chat (các tin nhắn) -->
                    <div class="chat-body flex-grow-1 p-3 overflow-auto">
                        <!-- Tin nhắn từ người khác (nhận) -->
                        <div class="message-item incoming mb-3 d-flex">
                            <div class="message-avatar mr-2">
                                <img src="images/testimonials/ts-2.jpg" alt="Avatar" class="rounded-circle">
                            </div>
                            <div class="message-content">
                                <div class="message-text">
                                    Hi, Harvey where are you now a days?
                                </div>
                                <div class="message-meta text-muted small">2:47 PM</div>
                            </div>
                        </div>

                        <!-- Tin nhắn từ mình (gửi) -->
                        <div class="message-item outgoing mb-3 d-flex justify-content-end">
                            <div class="message-content text-right">
                                <div class="message-text">
                                    I am in USA
                                </div>
                                <div class="message-meta text-muted small">2:48 PM</div>
                            </div>
                        </div>

                        <!-- Ví dụ tin nhắn tiếp -->
                        <div class="message-item incoming mb-3 d-flex">
                            <div class="message-avatar mr-2">
                                <img src="images/testimonials/ts-2.jpg" alt="Avatar" class="rounded-circle">
                            </div>
                            <div class="message-content">
                                <div class="message-text">
                                    Ok, what about admin template?
                                </div>
                                <div class="message-meta text-muted small">2:51 PM</div>
                            </div>
                        </div>

                        <div class="message-item outgoing mb-3 d-flex justify-content-end">
                            <div class="message-content text-right">
                                <div class="message-text">
                                    I have already purchased the admin template
                                </div>
                                <div class="message-meta text-muted small">2:54 PM</div>
                            </div>
                        </div>

                        <div class="message-item incoming mb-3 d-flex">
                            <div class="message-avatar mr-2">
                                <img src="images/testimonials/ts-2.jpg" alt="Avatar" class="rounded-circle">
                            </div>
                            <div class="message-content">
                                <div class="message-text">
                                    Ohh great, which admin template have you purchased?
                                </div>
                                <div class="message-meta text-muted small">3:01 PM</div>
                            </div>
                        </div>

                        <!-- ... Thêm tin nhắn khác -->
                    </div>
                    <!-- /Nội dung chat -->

                    <!-- Footer khung chat: ô nhập tin nhắn -->
                    <div class="chat-footer p-3 border-top">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Type a message...">
                            <div class="input-group-append">
                                <button class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /KHUNG CHAT BÊN PHẢI -->
            </div>
        </div> --}}
        <div class="dashborad-box">
            <h4 class="title">Review</h4>
            <div class="section-body">
                <div class="reviews">
                    <div class="review">
                        <div class="thumb">
                            <img class="img-fluid" src="images/testimonials/ts-4.jpg" alt="">
                        </div>
                        <div class="body">
                            <h5>Family House</h5>
                            <h6>Mary Smith</h6>
                            <p class="post-time">10 hours ago</p>
                            <p class="content mb-0 mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore</p>
                            <ul class="starts mb-0">
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star-o"></i>
                                </li>
                            </ul>
                            <div class="controller">
                                <ul>
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="far fa-trash-alt"></i></a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="review">
                        <div class="thumb">
                            <img class="img-fluid" src="images/testimonials/ts-5.jpg" alt="">
                        </div>
                        <div class="body">
                            <h5>Bay Apartment</h5>
                            <h6>Karl Tyron</h6>
                            <p class="post-time">22 hours ago</p>
                            <p class="content mb-0 mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore</p>
                            <ul class="starts mb-0">
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star-o"></i>
                                </li>
                            </ul>
                            <div class="controller">
                                <ul>
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="far fa-trash-alt"></i></a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="review">
                        <div class="thumb">
                            <img class="img-fluid" src="images/testimonials/ts-6.jpg" alt="">
                        </div>
                        <div class="body">
                            <h5>Family House Villa</h5>
                            <h6>Lisa Willis</h6>
                            <p class="post-time">51 hours ago</p>
                            <p class="content mb-0 mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore</p>
                            <ul class="starts mb-0">
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star-o"></i>
                                </li>
                            </ul>
                            <div class="controller">
                                <ul>
                                    <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="far fa-trash-alt"></i></a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
