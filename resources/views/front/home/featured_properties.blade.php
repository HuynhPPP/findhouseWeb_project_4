<section class="featured portfolio bg-white-2 rec-pro full-l">
    <div class="container-fluid">
        <div class="sec-title">
            <h2><span>Đề </span>xuất</h2>
            <p>Những bài đăng nổi bật chúng tôi đề xuất cho bạn</p>
        </div>
        <div class="row portfolio-items">
            @foreach ($posts_featured as $post)
                @php
                    $video_url = $post->video_url;
                    $video_url_fixed = str_replace('embed/', 'watch?v=', $video_url);

                    $randomImage = $post->images()->inRandomOrder()->first();
                @endphp
                <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 landscapes sale">
                    <div class="project-single" data-aos="fade-right">
                        <div class="project-inner project-head">
                            <div class="homes">
                                <!-- homes img -->
                                <a href="single-property-1.html" class="homes-img">
                                    <div class="homes-tag button alt featured">Đề xuất</div>
                                    <div class="homes-tag button alt sale">For Sale</div>
                                    @if ($randomImage)
                                        <img src="{{ asset($randomImage->image_url) }}" alt="home-1"
                                            class="img-responsive" style="height: 320px;">
                                    @else
                                        <img src="{{ asset('upload/no_image.jpg') }}" alt="No Image"
                                            class="img-responsive">
                                    @endif
                                </a>
                            </div>

                            <div class="button-effect">
                                <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                <a href="{{ $video_url_fixed }}" class="btn popup-video popup-youtube"><i
                                        class="fas fa-video"></i></a>
                                <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                            </div>
                        </div>
                        <!-- homes content -->
                        <div class="homes-content">
                            <!-- homes address -->
                            <h3><a href="single-property-1.html">
                                    {{ Str::words(strip_tags( $post->title), 14) }}
                                </a>
                            </h3>

                            <p class="homes-address mb-3">
                                <a href="single-property-1.html">
                                    <i class="fa fa-map-marker"></i>
                                    <span>
                                        {{ $post->full_address }}
                                    </span>
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
                                    <span>{{ $post->area }} m&sup2;</span>
                                </li>
                                <li class="the-icons">
                                    <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                    <span>2 Garages</span>
                                </li>
                            </ul>
                            <div class="price-properties footer pt-3 pb-0">
                                <h3 class="title mt-3">
                                    <a href="single-property-1.html">{{ $post->price }} triệu/tháng</a>
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
        <div class="bg-all">
            <a href="{{ route('all.post_recommend') }}" class="btn btn-outline-light">Xem thêm</a>
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
