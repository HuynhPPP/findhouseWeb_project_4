@extends('front.SecondPage')
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
                                            $totalImages = $post->images()->count();
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
                                                        <a href="#" class="btn copy-link"
                                                            data-link="{{ route('post.detail', $post->id) }}"><i
                                                                class="fa fa-link" style="line-height: 30px"></i></a>
                                                        @if ($video_url)
                                                            <a href="{{ $video_url_fixed }}"
                                                                class="btn popup-video popup-youtube"><i
                                                                    class="fas fa-video" style="line-height: 30px"></i></a>
                                                        @endif
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
                                                            <i
                                                                class="fa fa-map-marker"></i><span>{{ $post->full_address }}</span>
                                                        </a>
                                                    </p>
                                                    <!-- homes List -->
                                                    <ul class="homes-list clearfix pb-3">
                                                        <li class="the-icons">
                                                            <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                                            <span>{{ $post->area }} m²</span>
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
                                                            <a href="#" title="Chia sẻ" class="share-post"
                                                                data-link="{{ route('post.detail', $post->id) }}"
                                                                data-title="{{ $post->title }}"
                                                                data-post-id="{{ $post->id }}">
                                                                <i class="fas fa-share-alt"></i>
                                                            </a>
                                                            @if (auth()->check() && auth()->id() !== $post->user_id)
                                                                <a href="javascript:void(0)" title="Bấm để lưu tin"
                                                                    id="{{ $post->id }}"
                                                                    onclick="addToWishList(this.id, event)"
                                                                    class="save-post">
                                                                    <i class="{{ $post->isSavedByUser(auth()->user()) ? 'fas fa-heart' : 'far fa-heart' }}"
                                                                        id="heart-icon-{{ $post->id }}"></i>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Phân trang -->
                                <div class="d-flex justify-content-end" style="padding-bottom: 15px">
                                    {{ $posts->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </section>
                        <!-- END SIMILAR PROPERTIES -->
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
                                        <p class="author__meta">Số tin đăng - {{ $poster->posts->count() }}
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

                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                @php
                    $reviewCount = App\Models\Review::where('poster_id', $poster->id)
                        ->where('status', 1)
                        ->latest()
                        ->get();
                    $avarage = $reviewCount->avg('rating');
                @endphp

                <!-- Star Reviews -->
                <section class="col-lg-12 reviews comments mt-5 similar-property">
                    <h5 style="padding-bottom: 22px">Đánh giá từ khách hàng của {{ $poster->name }}
                        ({{ $reviews->total() }} đánh giá)</h5>

                    <div id="review-list">
                        @include('front.main.sort_page.reviews_sort')
                    </div>
                </section>

                <!-- End Reviews -->
            </div>
        </div>
    </section>
    <!-- END SECTION AGENTS DETAILS -->
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            // Bắt sự kiện click vào link phân trang trong review
            $(document).on('click', '#review-list .pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                fetchReviews(url);
            });

            function fetchReviews(url) {
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        $('#review-list').html(data);
                    },
                    error: function() {
                        Toast.fire({
                            icon: 'error',
                            title: 'Không thể tải đánh giá!'
                        });
                    }
                });
            }
        });
    </script>
@endsection
