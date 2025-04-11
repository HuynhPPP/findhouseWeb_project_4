@extends('front.master_2')
@section('home_2')
    <link rel="stylesheet" href="{{ asset('front/leaflet/leaflet.css') }}" />
    <style>
        #map {
            width: 100%;
            height: 400px;
        }
    </style>
    <title>{{ $post->title }}</title>
    <!-- START SECTION PROPERTIES LISTING -->
    <section class="single-proper blog details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 blog-pots">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- main slider carousel items -->
                            <div id="listingDetailsSlider" class="carousel listing-details-sliders slide mb-30">
                                <h5 class="mb-4">Danh mục ảnh</h5>
                                <div class="carousel-inner">
                                    @foreach ($images as $key => $image)
                                        <div class="item carousel-item {{ $key == 0 ? 'active' : '' }}"
                                            data-slide-number="{{ $key }}">
                                            <img src="{{ asset('upload/post_images/' . $image->image_url) }}"
                                                class="img-fluid" alt="slider-listing">
                                        </div>
                                    @endforeach
                                </div>

                                <a class="carousel-control left" href="#listingDetailsSlider" data-slide="prev"><i
                                        class="fa fa-angle-left"></i></a>
                                <a class="carousel-control right" href="#listingDetailsSlider" data-slide="next"><i
                                        class="fa fa-angle-right"></i></a>
                                <!-- main slider carousel nav controls -->
                                <!-- Thumbnail Indicators -->
                                <ul class="carousel-indicators smail-listing list-inline">
                                    @foreach ($images as $key => $image)
                                        <li class="list-inline-item {{ $key == 0 ? 'active' : '' }}">
                                            <a id="carousel-selector-{{ $key }}"
                                                data-slide-to="{{ $key }}" data-target="#listingDetailsSlider">
                                                <img src="{{ asset('upload/post_images/' . $image->image_url) }}"
                                                    class="img-fluid-2" alt="listing-small">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- main slider carousel items -->
                            </div>
                            <div class="blog-info details mb-30">
                                <h5 class="mb-4">Thông tin chung</h5>
                                <h4>{{ $post->title }}</h4>
                                <div class="mt-0">
                                    <a href="#listing-location" class="listing-address" style="color: #666">
                                        <i
                                            class="fa fa-map-marker pr-2 ti-location-pin mrg-r-5"></i>{{ $post->full_address }}
                                    </a>
                                </div>
                                <div class="homes-content">
                                    <ul class="homes-list clearfix">
                                        <li>
                                            <h3 class="title mt-3" style="color: #18ba60;">
                                                @if ($post->price >= 1000000)
                                                    {{ number_format($post->price / 1000000, 1) }} triệu/tháng
                                                @else
                                                    {{ number_format($post->price, 0, ',', '.') }} đồng/tháng
                                                @endif
                                            </h3>
                                        </li>
                                        <li class="mt-1" style="line-height: 45px">
                                            <span class="font-weight-bold mr-1 ">Diện tích:</span>
                                            <span class="det">{{ $post->area }}m&sup2</span>
                                        </li>
                                        <li class="mt-1" style="line-height: 45px">
                                            <span class="font-weight-bold mr-1 ">Cập nhật:</span>
                                            <span class="det">
                                                {{ \Carbon\Carbon::parse($post->updated_at)->locale('vi')->diffForHumans() }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                                <h5 class="mb-4 mt-5">Thông tin mô tả</h5>
                                {!! $post->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="property wprt-image-video w50 pro">
                        @php
                            $video_url = $post->video_url;
                            $video_url_fixed = str_replace('embed/', 'watch?v=', $video_url);
                        @endphp
                        <h5>Video</h5>
                        <iframe width="680" height="400" src="{{ $video_url }}" frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                    <div class="property-location map">
                        <h5>Vị trí trên bản đồ</h5>
                        <div class="divider-fade"></div>
                        <div id="map" class="contact-map">

                        </div>
                    </div>

                    @php
                        $reviewCount = App\Models\Review::where('post_id', $post->id)
                            ->where('status', 1)
                            ->latest()
                            ->get();
                        $avarage = $reviewCount->avg('rating');
                    @endphp

                    <!-- Star Reviews -->
                    <section class="reviews comments">
                        <h3 class="mb-5">{{ $reviewCount->count() }} Đánh giá</h3>

                        @foreach ($reviewCount as $item)
                            @php
                                $imagePath = 'upload/user_images/';
                                $userPhoto = $item->user->photo ?? null;

                                if (!empty($userPhoto)) {
                                    $imageUrl = url($imagePath . $userPhoto);
                                } else {
                                    $imageUrl = url('upload/no_img.jpg');
                                }
                            @endphp

                            <div class="row mb-5">
                                <ul class="col-12 commented pl-0">
                                    <li class="comm-inf">
                                        <div class="col-md-2">
                                            <img src="{{ $imageUrl }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-md-10 comments-info">
                                            <div class="conra">
                                                <h5 class="mb-2">{{ $item->user->name }}</h5>
                                                <div class="rating-box">
                                                    <div class="detail-list-rating mr-0">
                                                        @if ($item->rating == null)
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        @elseif ($item->rating == 1)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        @elseif ($item->rating == 2)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        @elseif ($item->rating == 3)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        @elseif ($item->rating == 4)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        @elseif ($item->rating == 5)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mb-4">
                                                {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                                            <p>{{ $item->comment }}</p>
                                            {{-- <div class="rest"><img
                                                    src="{{ asset('front/images/single-property/s-1.jpg') }}"
                                                    class="img-fluid" alt=""></div> --}}
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        @endforeach

                    </section>
                    <!-- End Reviews -->

                    @guest
                        <section class="single reviews leve-comments details">
                            <div id="add-review" class="add-review-box">
                                <!-- Add Review -->
                                <h3 class="listing-desc-headline margin-bottom-20 mb-4">Thêm đánh giá</h3>
                                <div class="alert alert-warning">
                                    Bạn cần <a class="text-danger"
                                        href="http://127.0.0.1:8000/user/login?redirect=http%3A%2F%2F127.0.0.1%3A8000%2Fpost%2Fdetails%2F102">
                                        đăng nhập
                                    </a>
                                    trước khi gửi đánh giá.
                                </div>
                            </div>
                        </section>
                    @else
                        @auth
                            @if (auth()->id() != $post->user_id)
                                <!-- Star Add Review -->
                                <section class="single reviews leve-comments details">
                                    <div id="add-review" class="add-review-box">
                                        <!-- Add Review -->
                                        <h3 class="listing-desc-headline margin-bottom-20 mb-4">Thêm đánh giá</h3>

                                        <form action="{{ route('store.review') }}" method="POST">
                                            @csrf
                                            <span class="leave-rating-title">Độ yêu thích của bạn dành cho bài đăng này</span>
                                            <!-- Rating / Upload Button -->
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <input type="hidden" name="poster_id" value="{{ $post->user_id }}">

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <!-- Leave Rating -->
                                                    <div class="clearfix"></div>
                                                    <div class="leave-rating margin-bottom-30">
                                                        <input type="radio" name="rating" id="rating-1" value="5" />
                                                        <label for="rating-1" class="fa fa-star"></label>
                                                        <input type="radio" name="rating" id="rating-2" value="4" />
                                                        <label for="rating-2" class="fa fa-star"></label>
                                                        <input type="radio" name="rating" id="rating-3" value="3" />
                                                        <label for="rating-3" class="fa fa-star"></label>
                                                        <input type="radio" name="rating" id="rating-4" value="2" />
                                                        <label for="rating-4" class="fa fa-star"></label>
                                                        <input type="radio" name="rating" id="rating-5" value="1" />
                                                        <label for="rating-5" class="fa fa-star"></label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- Uplaod Photos -->
                                                    <div class="add-review-photos margin-bottom-30">
                                                        <div class="photoUpload">
                                                            <span><i class="sl sl-icon-arrow-up-circle"></i> Tải ảnh lên</span>
                                                            <input type="file" class="upload" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 data">
                                                    <div class="col-md-12 form-group">
                                                        <textarea name="comment" class="form-control" id="exampleTextarea" rows="8" placeholder="Viết đánh giá"
                                                            required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-lg mt-2">Gửi đánh
                                                        giá</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </section>
                                <!-- End Add Review -->
                            @endif
                        @endauth
                    @endguest


                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">
                        <!-- end author-verified-badge -->
                        <div class="sidebar">
                            <div class="widget-boxed mt-33">
                                <div class="widget-boxed-header">
                                    <h4>Thông tin liên hệ</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="sidebar-widget author-widget2">
                                        <div class="author-box clearfix">
                                            @php
                                                $imagePath = 'upload/user_images/';
                                                $userPhoto = $post->user->photo ?? null;

                                                if (!empty($userPhoto)) {
                                                    $imageUrl = url($imagePath . $userPhoto);
                                                } else {
                                                    $imageUrl = url('upload/no_img.jpg');
                                                }
                                            @endphp
                                            <a href="{{ route('poster.detail', $post->user->id) }}">
                                                <img src="{{ $imageUrl }}" alt="author-image" class="author__img">
                                                <h4 class="author__title">{{ $post->user->name }}</h4>
                                            </a>
                                            <p class="author__meta">Số tin đăng - {{ $post->user->posts->count() }}
                                            </p>
                                        </div>
                                        <ul class="author__contact">
                                            <li><span class="la la-phone"><i class="fa fa-phone"
                                                        aria-hidden="true"></i></span><a
                                                    href="#">{{ $post->user->phone }}</a></li>
                                            <li><span class="la la-envelope-o"><i class="fa fa-envelope"
                                                        aria-hidden="true"></i></span><a
                                                    href="#">{{ $post->user->email }}</a>
                                            </li>
                                        </ul>
                                        @if (auth()->id() != $post->user_id)
                                        <div class="agent-contact-form-sidebar">
                                            <h4>Liên hệ để thuê</h4>

                      @auth
                        @php
                          $booking = App\Models\Bookings::where(
                              'post_id',
                              $post->id,
                          )
                              ->where('user_id', Auth::user()->id)
                              ->first();
                        @endphp

                        @php
                          $profileData = Auth::user(); // Lấy user hiện tại
                        @endphp
                        <!-- Nếu đã đăng nhập, hiển thị form -->
                        @if ($booking && $booking->status == 'pending')
                          <form method="POST"
                            action="{{ route('bookings.cancel', $booking->id) }}">
                            @csrf
                            <input type="hidden" name="post_id"
                              value="{{ $post->id }}">
                            <input type="hidden" name="user_id"
                              value="{{ $profileData->id }}">

                            <input type="text" id="fname" name="full_name"
                              value="{{ $profileData->name }}" readonly />

                            <input type="number" id="pnumber"
                              name="phone_number"
                              value="{{ $profileData->phone ?? 'Chưa cập nhật' }}"
                              readonly />

                            <input type="email" id="emailid"
                              name="email_address"
                              value="{{ $profileData->email ?? 'Chưa cập nhật' }}"
                              readonly />

                            <input type="submit" id="cancel_booking"
                              class="multiple-send-message" value="Huỷ yêu cầu" />
                          </form>
                        @else
                          <form name="contact_form" method="post"
                            action="{{ route('bookings.store') }}">
                            @csrf
                            <input type="hidden" name="post_id"
                              value="{{ $post->id }}">
                            <input type="hidden" name="user_id"
                              value="{{ $profileData->id }}">

                            <label for="fname">Họ tên</label>
                            <input type="text" id="fname" name="full_name"
                              value="{{ $profileData->name }}" readonly />

                            <label for="fname">Số điện thoại</label>
                            <input type="text" id="pnumber"
                              name="phone_number"
                              value="{{ $profileData->phone ?? 'Chưa cập nhật' }}"
                              readonly />

                            <label for="fname">Email</label>
                            <input type="email" id="emailid"
                              name="email_address"
                              value="{{ $profileData->email ?? 'Chưa cập nhật' }}"
                              readonly />

                            <input type="submit" id="submit_booking"
                              class="multiple-send-message" value="Gửi yêu cầu" />

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
                                                    </a> trước khi gửi yêu cầu liên hệ.
                                                </div>

                      @endauth

                                        </div>
                                        @endif

                  </div>
                </div>
              </div>

              <div class="main-search-field-2">
                <div class="widget-boxed mt-5">
                  <div class="widget-boxed-header">
                    <h4>Bài đăng mới nhất</h4>
                  </div>
                  <div class="widget-boxed-body">
                    <div class="recent-post">
                      <div class="recent-main">
                        <div class="recent-img">
                          <a href="blog-details.html"><img
                              src="images/feature-properties/fp-1.jpg"
                              alt=""></a>
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
                              src="images/feature-properties/fp-2.jpg"
                              alt=""></a>
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
                              src="images/feature-properties/fp-3.jpg"
                              alt=""></a>
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
                <div class="widget-boxed popular mt-5">
                  <div class="widget-boxed-header">
                    <h4>Tìm kiếm theo từ khoá</h4>
                  </div>
                  <div class="widget-boxed-body">
                    <div class="recent-post">
                      <div class="tags">
                        <span><a href="#"
                            class="btn btn-outline-primary">Houses</a></span>
                        <span><a href="#"
                            class="btn btn-outline-primary">Real
                            Home</a></span>
                      </div>
                      <div class="tags">
                        <span><a href="#"
                            class="btn btn-outline-primary">Baths</a></span>
                        <span><a href="#"
                            class="btn btn-outline-primary">Beds</a></span>
                      </div>
                      <div class="tags">
                        <span><a href="#"
                            class="btn btn-outline-primary">Garages</a></span>
                        <span><a href="#"
                            class="btn btn-outline-primary">Family</a></span>
                      </div>
                      <div class="tags">
                        <span><a href="#"
                            class="btn btn-outline-primary">Real
                            Estates</a></span>
                        <span><a href="#"
                            class="btn btn-outline-primary">Properties</a></span>
                      </div>
                      <div class="tags no-mb">
                        <span><a href="#"
                            class="btn btn-outline-primary">Location</a></span>
                        <span><a href="#"
                            class="btn btn-outline-primary">Price</a></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </aside>
      </div>
      <!-- START SIMILAR PROPERTIES -->
      <section class="similar-property featured portfolio p-0 bg-white-inner">
        @if ($relatedPosts->count() > 0)
          <div class="container mt-5">
            <h5>Bài đăng có liên quan</h5>
            <div class="row portfolio-items">
              @foreach ($relatedPosts as $related)
                @php
                  $video_url = $related->video_url;
                  $video_url_fixed = str_replace(
                      'embed/',
                      'watch?v=',
                      $video_url,
                  );

                                    $fixedImage = $post->images()->first();
                                @endphp
                                <div class="item col-lg-4 col-md-6 col-xs-12 landscapes">
                                    <div class="project-single">
                                        <div class="project-inner project-head">
                                            <div class="project-bottom">
                                                <h4><a href="{{ route('post.detail', $related->id) }}">
                                                        Xem chi tiết
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="homes">
                                                <!-- homes img -->
                                                <div class="homes-tag button alt sale">
                                                    {{ $related->category->category_name }}</div>
                                                <div class="homes-price">
                                                    @if ($related->price >= 1000000)
                                                        {{ number_format($related->price / 1000000, 1) }} triệu/tháng
                                                    @else
                                                        {{ number_format($related->price, 0, ',', '.') }} đồng/tháng
                                                    @endif
                                                </div>
                                                @if ($fixedImage)
                                                    <img src="{{ asset('upload/post_images/' . $fixedImage->image_url) }}"
                                                        alt="home-1" class="img-responsive" style="height: 270px;">
                                                @else
                                                    <img src="{{ asset('upload/no_image.jpg') }}" alt="No Image"
                                                        class="img-responsive">
                                                @endif
                                            </div>
                                            <div class="button-effect">
                                                <a href="{{ $video_url_fixed }}" class="btn popup-video popup-youtube"><i
                                                        class="fas fa-video"></i></a>
                                            </div>
                                        </div>
                                        <!-- homes content -->
                                        <div class="homes-content">
                                            <!-- homes address -->
                                            <h3><a
                                                    href="{{ route('post.detail', $related->id) }}">{{ $related->title }}</a>
                                            </h3>
                                            <p class="homes-address mb-3">
                                                <a href="single-property-1.html">
                                                    <i
                                                        class="fa fa-map-marker"></i><span>{{ $related->full_address }}</span>
                                                </a>
                                            </p>
                                            <!-- homes List -->
                                            <ul class="homes-list clearfix pb-3">
                                                <li class="the-icons">
                                                    <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                    <span>6 Bedrooms</span>
                                                </li>
                                                <li class="the-icons">
                                                    <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                    <span>3 Bathrooms</span>
                                                </li>
                                                <li class="the-icons">
                                                    <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                                    <span>720 sq ft</span>
                                                </li>
                                                <li class="the-icons">
                                                    <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                                    <span>2 Garages</span>
                                                </li>
                                            </ul>
                                            <div class="footer">
                                                <a href="{{ route('poster.detail', $related->user->id) }}">
                                                    @php
                                                        $imagePath = 'upload/user_images/';
                                                        $userPhoto = $related->user->photo ?? null;

                                                        if (!empty($userPhoto)) {
                                                            $imageUrl = url($imagePath . $userPhoto);
                                                        } else {
                                                            $imageUrl = url('upload/no_img.jpg');
                                                        }
                                                    @endphp

                                                    <img src="{{ $imageUrl }}" alt="User Image" class="mr-2"
                                                        style="width: 35px; height: 35px; object-fit: cover; border-radius: 50%;">
                                                    {{ $related->user->name }}
                                                </a>
                                                <span
                                                    style="margin-top: 7px">{{ \Carbon\Carbon::parse($related->created_at)->locale('vi')->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </section>
            <!-- END SIMILAR PROPERTIES -->
        </div>
        <div id="app-live-chat">
            @php
                $defaultImage = url('upload/no_img.jpg');
                $imagePath = $defaultImage;

                if (!empty($post->user->photo)) {
                    if (str_contains($post->user->photo, 'poster_')) {
                        $imagePath = url('upload/user_images/' . $post->user->photo);
                    } elseif (str_contains($post->user->photo, 'user_')) {
                        $imagePath = url('upload/user_images/' . $post->user->photo);
                    }
                }
            @endphp
            <send-message :poster_id="{{ $post->user_id }}" :post_name="'{{ $post->title }}'"
                :post_id="{{ $post->id }}" :poster_name="'{{ $post->user->name }}'" :price="{{ $post->price }}"
                :poster_avatar="'{{ $imagePath }}'">
            </send-message>
        </div>
    </section>
    <!-- END SECTION PROPERTIES LISTING -->
@endsection

@section('customJs')
    <script src="{{ asset('front/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('front/js/map_post_view.js') }}"></script>

  <script>
    $(function() {
      $(document).on('click', '#submit_booking', function(e) {
        e.preventDefault(); // Ngăn form submit ngay
        var form = $(this).closest(
          'form'); // Lấy đối tượng form chứa nút này
        Swal.fire({
          title: 'Bạn có chắc chắn?',
          text: "Bạn muốn yêu cầu thuê ",
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Đồng ý',
          cancelButtonText: 'Không'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  </script>

  <script>
    $(function() {
      $(document).on('click', '#cancel_booking', function(e) {
        e.preventDefault(); // Ngăn form submit ngay
        var form = $(this).closest(
          'form'); // Lấy đối tượng form chứa nút này
        Swal.fire({
          title: 'Bạn có chắc chắn?',
          text: "Bạn muốn huỷ yêu cầu thuê này?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Huỷ yêu cầu',
          cancelButtonText: 'Không'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  </script>
@endsection
