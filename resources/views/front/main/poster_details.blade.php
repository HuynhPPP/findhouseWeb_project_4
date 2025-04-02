@extends('front.master_2')
@section('home_2')
    <title>{{ $poster->name }}</title>

    <!-- START SECTION AGENTS DETAILS -->
    <section class="blog blog-section portfolio single-proper details mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-xs-12">
                    <div class="blog-pots">
                        <!-- START SIMILAR PROPERTIES -->
                        <section class="similar-property featured portfolio bshd p-0 bg-white">
                            <div class="container">
                                <h5 style="padding-top: 22px">Danh sách tin đăng của {{ $poster->name }}</h5>
                                <div class="row">
                                    @foreach ($posts as $post)
                                        @php
                                            $video_url = $post->video_url;
                                            $video_url_fixed = str_replace('embed/', 'watch?v=', $video_url);

                                            $fixedImage = $post->images()->first();
                                        @endphp
                                        <div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                                            <div class="project-single">
                                                <div class="project-inner project-head">
                                                    <div class="project-bottom">
                                                        <h4><a href="{{ route('post.detail', $post->id) }}">
                                                                Xem chi tiết
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div class="homes">
                                                        <!-- homes img -->
                                                        <a href="{{ route('post.detail', $post->id) }}" class="homes-img">
                                                            <div class="homes-tag button alt sale">
                                                                {{ $post->category->category_name }}</div>
                                                            @if ($fixedImage)
                                                                <img src="{{ asset('upload/post_images/' . $fixedImage->image_url) }}"
                                                                    alt="home-1" class="img-responsive"
                                                                    style="height: 270px;">
                                                            @else
                                                                <img src="{{ asset('upload/no_image.jpg') }}" alt="No Image"
                                                                    class="img-responsive">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="button-effect">
                                                        <a href="single-property-1.html" class="btn"><i
                                                                class="fa fa-link"></i></a>
                                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                                            class="btn popup-video popup-youtube"><i
                                                                class="fas fa-video"></i></a>
                                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                                class="fa fa-photo"></i></a>
                                                    </div>
                                                </div>
                                                <!-- homes content -->
                                                <div class="homes-content">
                                                    <!-- homes address -->
                                                    <h3><a
                                                            href="single-property-1.html">{{ Str::words(strip_tags($post->title), 10) }}</a>
                                                    </h3>
                                                    <p class="homes-address mb-3">
                                                        <a href="single-property-1.html">
                                                            <i class="fa fa-map-marker"></i><span>{{ $post->full_address }}</span>
                                                        </a>
                                                    </p>
                                                    <!-- homes List -->
                                                    <ul class="homes-list clearfix">
                                                        <li>
                                                            <span>6 Beds</span>
                                                        </li>
                                                        <li>
                                                            <span>3 Baths</span>
                                                        </li>
                                                        <li>
                                                            <span>{{ $post->area }} m&sup2;</span>
                                                        </li>
                                                        <li>
                                                            <span>2 Garages</span>
                                                        </li>
                                                    </ul>
                                                    <div class="price-properties footer pt-3 pb-0">
                                                        <h3 class="title mt-3">
                                                            <a href="single-property-1.html">
                                                                @if ($post->price >= 1000000)
                                                                    {{ number_format($post->price / 1000000, 1) }}
                                                                    triệu/tháng
                                                                @else
                                                                    {{ number_format($post->price, 0, ',', '.') }}
                                                                    đồng/tháng
                                                                @endif
                                                            </a>
                                                        </h3>

                                                        <div class="compare">
                                                            <a href="#" title="Compare">
                                                                <i class="flaticon-compare"></i>
                                                            </a>
                                                            <a href="#" title="Share">
                                                                <i class="flaticon-share"></i>
                                                            </a>
                                                            <a href="#" title="Favorites">
                                                                <i class="flaticon-heart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                        <!-- END SIMILAR PROPERTIES -->
                        <!-- Star Reviews -->
                        <section class="reviews comments mt-5">
                            <h3 class="mb-5">3 Reviews</h3>
                            <div class="row mb-5">
                                <ul class="col-12 commented pl-0">
                                    <li class="comm-inf">
                                        <div class="col-md-2">
                                            <img src="images/testimonials/ts-5.jpg" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-md-10 comments-info">
                                            <div class="conra">
                                                <h5 class="mb-2">Mary Smith</h5>
                                                <div class="rating-box">
                                                    <div class="detail-list-rating mr-0">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mb-4">May 30 2020</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras aliquam, quam
                                                congue dictum luctus, lacus magna congue ante, in finibus dui sapien eu
                                                dolor. Integer tincidunt suscipit erat, nec laoreet ipsum vestibulum sed.
                                            </p>
                                            <div class="rest"><img src="images/single-property/s-1.jpg" class="img-fluid"
                                                    alt=""></div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="row">
                                <ul class="col-12 commented pl-0">
                                    <li class="comm-inf">
                                        <div class="col-md-2">
                                            <img src="images/testimonials/ts-2.jpg" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-md-10 comments-info">
                                            <div class="conra">
                                                <h5 class="mb-2">Abraham Tyron</h5>
                                                <div class="rating-box">
                                                    <div class="detail-list-rating mr-0">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mb-4">june 1 2020</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras aliquam, quam
                                                congue dictum luctus, lacus magna congue ante, in finibus dui sapien eu
                                                dolor. Integer tincidunt suscipit erat, nec laoreet ipsum vestibulum sed.
                                            </p>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="row mt-5">
                                <ul class="col-12 commented mb-0 pl-0">
                                    <li class="comm-inf">
                                        <div class="col-md-2">
                                            <img src="images/testimonials/ts-3.jpg" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-md-10 comments-info">
                                            <div class="conra">
                                                <h5 class="mb-2">Lisa Williams</h5>
                                                <div class="rating-box">
                                                    <div class="detail-list-rating mr-0">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mb-4">jul 12 2020</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras aliquam, quam
                                                congue dictum luctus, lacus magna congue ante, in finibus dui sapien eu
                                                dolor. Integer tincidunt suscipit erat, nec laoreet ipsum vestibulum sed.
                                            </p>
                                            <div class="resti">
                                                <div class="rest"><img src="images/single-property/s-2.jpg"
                                                        class="img-fluid" alt=""></div>
                                                <div class="rest"><img src="images/single-property/s-3.jpg"
                                                        class="img-fluid" alt=""></div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </section>
                        <!-- End Reviews -->
                        <!-- Star Add Review -->
                        <section class="single reviews leve-comments details">
                            <div id="add-review" class="add-review-box">
                                <!-- Add Review -->
                                <h3 class="listing-desc-headline margin-bottom-20 mb-4">Leave A Review For Carls Jhons</h3>
                                <span class="leave-rating-title">Your rating for this listing</span>
                                <!-- Rating / Upload Button -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <!-- Leave Rating -->
                                        <div class="clearfix"></div>
                                        <div class="leave-rating margin-bottom-30">
                                            <input type="radio" name="rating" id="rating-1" value="1" />
                                            <label for="rating-1" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-2" value="2" />
                                            <label for="rating-2" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-3" value="3" />
                                            <label for="rating-3" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-4" value="4" />
                                            <label for="rating-4" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-5" value="5" />
                                            <label for="rating-5" class="fa fa-star"></label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Uplaod Photos -->
                                        <div class="add-review-photos margin-bottom-30">
                                            <div class="photoUpload">
                                                <span><i class="sl sl-icon-arrow-up-circle"></i> Upload Photos</span>
                                                <input type="file" class="upload" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 data">
                                        <form action="#">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="First Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Last Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control"
                                                        placeholder="Email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea class="form-control" id="exampleTextarea" rows="8" placeholder="Review" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-lg mt-2">Submit
                                                Review</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End Add Review -->
                    </div>
                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">
                        <div class="widget-boxed mt-33">
                            <div class="widget-boxed-header">
                                <h4>Thông tin liên hệ</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="sidebar-widget author-widget2">
                                    <div class="author-box clearfix">
                                        @php
                                            $imagePath = 'upload/user_images/';
                                            $userPhoto = $poster->photo ?? null;

                                            if (!empty($userPhoto)) {
                                                $imageUrl = url($imagePath . $userPhoto);
                                            } else {
                                                $imageUrl = url('upload/no_img.jpg');
                                            }
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="author-image" class="author__img">
                                        <h4 class="author__title">{{ $poster->name }}</h4>
                                        <p class="author__meta">Số tin đăng - {{ $post->count() }}
                                        </p>
                                    </div>
                                    <ul class="author__contact">
                                        <li><span class="la la-phone"><i class="fa fa-phone"
                                                    aria-hidden="true"></i></span><a
                                                href="#">{{ $poster->phone }}</a></li>
                                        <li><span class="la la-envelope-o"><i class="fa fa-envelope"
                                                    aria-hidden="true"></i></span><a
                                                href="#">{{ $poster->email }}</a>
                                        </li>
                                    </ul>
                                    <div class="agent-contact-form-sidebar">
                                        <h4>Liên hệ để thuê</h4>

                                        @auth
                                            @php
                                                $booking = App\Models\Bookings::where('post_id', $post->id)
                                                    ->where('user_id', Auth::user()->id)
                                                    ->first();
                                            @endphp

                                            @php
                                                $profileData = Auth::user(); // Lấy user hiện tại
                                            @endphp
                                            <!-- Nếu đã đăng nhập, hiển thị form -->
                                            @if ($booking && $booking->status == 'pending')
                                                <form method="POST" action="{{ route('bookings.cancel', $booking->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                    <input type="hidden" name="user_id" value="{{ $profileData->id }}">

                                                    <input type="text" id="fname" name="full_name"
                                                        value="{{ $profileData->name }}" readonly />

                                                    <input type="number" id="pnumber" name="phone_number"
                                                        value="{{ $profileData->phone ?? 'Chưa cập nhật' }}" readonly />

                                                    <input type="email" id="emailid" name="email_address"
                                                        value="{{ $profileData->email ?? 'Chưa cập nhật' }}" readonly />

                                                    <input type="submit" id="cancel_booking" class="multiple-send-message"
                                                        value="Huỷ yêu cầu" />
                                                </form>
                                            @else
                                                <form name="contact_form" method="post"
                                                    action="{{ route('bookings.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                    <input type="hidden" name="user_id" value="{{ $profileData->id }}">

                                                    <label for="fname">Họ tên</label>
                                                    <input type="text" id="fname" name="full_name"
                                                        value="{{ $profileData->name }}" readonly />

                                                    <label for="fname">Số điện thoại</label>
                                                    <input type="text" id="pnumber" name="phone_number"
                                                        value="{{ $profileData->phone ?? 'Chưa cập nhật' }}" readonly />

                                                    <label for="fname">Email</label>
                                                    <input type="email" id="emailid" name="email_address"
                                                        value="{{ $profileData->email ?? 'Chưa cập nhật' }}" readonly />

                                                    <input type="submit" id="submit_booking" class="multiple-send-message"
                                                        value="Gửi yêu cầu" />

                                                </form>
                                                <!-- Nút mở chat (sẽ được thay thế bởi Vue) -->
                                                <div id="chatButtonApp">
                                                    <chat-button @open-chat="openChatPopup"></chat-button>
                                                </div>
                                            @endif
                                        @else
                                            <!-- Nếu chưa đăng nhập, hiển thị thông báo -->
                                            <div class="alert alert-warning">
                                                Bạn cần <a class="text-danger"
                                                    href="{{ route('login', ['redirect' => request()->fullUrl()]) }}">
                                                    đăng nhập
                                                </a>
                                                đăng nhập </a> trước khi gửi yêu cầu liên hệ.
                                            </div>

                                        @endauth

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end author-verified-badge -->
                        <div class="sidebar">
                            <div class="main-search-field-2">
                                <div class="widget-boxed mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>Recent Properties</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="recent-post">
                                            <div class="recent-main">
                                                <div class="recent-img">
                                                    <a href="blog-details.html"><img
                                                            src="images/feature-properties/fp-1.jpg" alt=""></a>
                                                </div>
                                                <div class="info-img">
                                                    <a href="blog-details.html">
                                                        <h6>Family Home</h6>
                                                    </a>
                                                    <p>$230,000</p>
                                                </div>
                                            </div>
                                            <div class="recent-main my-4">
                                                <div class="recent-img">
                                                    <a href="blog-details.html"><img
                                                            src="images/feature-properties/fp-2.jpg" alt=""></a>
                                                </div>
                                                <div class="info-img">
                                                    <a href="blog-details.html">
                                                        <h6>Family Home</h6>
                                                    </a>
                                                    <p>$230,000</p>
                                                </div>
                                            </div>
                                            <div class="recent-main">
                                                <div class="recent-img">
                                                    <a href="blog-details.html"><img
                                                            src="images/feature-properties/fp-3.jpg" alt=""></a>
                                                </div>
                                                <div class="info-img">
                                                    <a href="blog-details.html">
                                                        <h6>Family Home</h6>
                                                    </a>
                                                    <p>$230,000</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
    <!-- END SECTION AGENTS DETAILS -->
@endsection
