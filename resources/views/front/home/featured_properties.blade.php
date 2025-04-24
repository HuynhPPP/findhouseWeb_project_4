<section class="featured portfolio bg-white-2 rec-pro full-l">
    <div class="container-fluid">
        <div class="sec-title">
            <h2><span>Đề </span>xuất</h2>
            <p>Những tin đăng nổi bật chúng tôi đề xuất cho bạn</p>
        </div>
        <div class="row portfolio-items">
            @foreach ($posts_featured as $post)
                @php
                    $video_url = $post->video_url;
                    $video_url_fixed = str_replace('embed/', 'watch?v=', $video_url);

                    $fixedImage = $post->images()->first();
                    $totalImages = $post->images()->count();

                @endphp
                <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 landscapes sale">
                    <div class="project-single" data-aos="fade-right">
                        <div class="project-inner project-head">
                            <div class="homes">
                                <!-- homes img -->
                                <a href="#" class="homes-img">
                                    <div class="homes-tag button alt featured">Đề xuất</div>
                                    <div class="homes-tag button alt sale">{{ $post->category->category_name }}</div>
                                    @if ($fixedImage)
                                        <img src="{{ asset('upload/post_images/' . $fixedImage->image_url) }}"
                                            alt="home-1" class="img-responsive" style="height: 270px">
                                    @else
                                        <img src="{{ asset('upload/no_image.jpg') }}" alt="No Image"
                                            class="img-responsive" style="height: 270px">
                                    @endif

                                </a>
                            </div>

                            <div class="button-effect">
                                <a class="btn copy-link"
                                    data-link="{{ route('post.detail', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}"><i class="fa fa-link"
                                        style="line-height: 30px"></i></a>
                                @if ($video_url)
                                    <a href="{{ $video_url_fixed }}" class="btn popup-video popup-youtube"><i
                                            class="fas fa-video" style="line-height: 30px"></i></a>
                                @endif
                                <a class="img-poppu btn">
                                    {{ $totalImages }} <i class="fa fa-photo"></i>
                                </a>
                            </div>
                        </div>
                        <!-- homes content -->
                        <div class="homes-content">
                            <!-- homes address -->
                            <h3><a href="{{ route('post.detail', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}">
                                    {{ Str::words(strip_tags($post->title), 14) }}
                                </a>
                            </h3>

                            <p class="homes-address mb-3">
                                <a href="{{ route('post.detail', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}">
                                    <i class="fa fa-map-marker"></i>
                                    <span>
                                        {{ $post->full_address }}
                                    </span>
                                </a>
                            </p>
                            <!-- homes List -->
                            <ul class="homes-list clearfix pb-3">
                                <li class="the-icons">
                                    <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                    <span>{{ $post->area }} m&sup2;</span>
                                </li>
                            </ul>
                            <div class="price-properties footer pt-3 pb-0">
                                <h3 class="title mt-3">
                                    <a href="{{ route('post.detail', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}">
                                        @if ($post->price >= 1000000)
                                            {{ number_format($post->price / 1000000, 1) }} triệu/tháng
                                        @else
                                            {{ number_format($post->price, 0, ',', '.') }} đồng/tháng
                                        @endif
                                    </a>
                                </h3>

                                <div class="compare">
                                    <a href="#" title="Bấm để lấy liên kết">
                                        <i class="flaticon-share"></i>
                                    </a>
                                    <a href="javascript:void(0)" title="Bấm để lưu tin" id="{{ $post->id }}"
                                        onclick="addToWishList(this.id, event)" class="save-post">
                                        <i class="{{ $post->isSavedByUser(auth()->user()) ? 'fas fa-heart' : 'far fa-heart' }}"
                                            id="heart-icon-{{ $post->id }}"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

    </div>
    <div class="bg-all">
      <a href="{{ route('all.post_recommend') }}"
        class="btn btn-outline-light">Xem thêm</a>
    </div>
  </div>
</section>
@section('customJs')
    <script>
        $(document).ready(function() {
            $('.popup-youtube').magnificPopup({
                type: 'iframe'
            });
        });
    </script>
@endsection
