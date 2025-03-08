<section class="featured portfolio bg-white-2 rec-pro full-l">
    <div class="container-fluid">
        <div class="sec-title">
            <h2><span>Đề </span>xuất</h2>
            <p>Những bài đăng nổi bật chúng tôi đề xuất cho bạn</p>
        </div>
        <div class="row portfolio-items">
            <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 landscapes sale">
                <div class="project-single" data-aos="fade-right">

                    @php
                        $video_url = 'https://www.youtube.com/embed/SXuUCPPe2Jg'; // Lấy từ database
                        $video_url_fixed = str_replace('embed/', 'watch?v=', $video_url);
                    @endphp

                    <div class="project-inner project-head">
                        <div class="homes">
                            <!-- homes img -->
                            <a href="single-property-1.html" class="homes-img">
                                <div class="homes-tag button alt featured">Featured</div>
                                <div class="homes-tag button alt sale">For Sale</div>
                                <img src="images/blog/b-11.jpg" alt="home-1" class="img-responsive">
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
                        <h3><a href="single-property-1.html">Real Luxury Family House Villa</a></h3>
                        <p class="homes-address mb-3">
                            <a href="single-property-1.html">
                                <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South, NYC</span>
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
                        <div class="price-properties footer pt-3 pb-0">
                            <h3 class="title mt-3">
                                <a href="single-property-1.html">$ 150,000</a>
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
            <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 people rent">
                <div class="project-single" data-aos="fade-left">
                    <div class="project-inner project-head">
                        <div class="homes">
                            <!-- homes img -->
                            <a href="single-property-1.html" class="homes-img">
                                <div class="homes-tag button sale rent">For Rent</div>
                                <img src="images/blog/b-12.jpg" alt="home-1" class="img-responsive">
                            </a>
                        </div>
                        <div class="button-effect">
                            <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                            <a href="{{ $video_url_fixed }}"
                                class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                            <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                        </div>
                    </div>
                    <!-- homes content -->
                    <div class="homes-content">
                        <!-- homes address -->
                        <h3><a href="single-property-1.html">Real Luxury Family House Villa</a></h3>
                        <p class="homes-address mb-3">
                            <a href="single-property-1.html">
                                <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South, NYC</span>
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
                        <div class="price-properties footer pt-3 pb-0">
                            <h3 class="title mt-3">
                                <a href="single-property-1.html">$ 150,000</a>
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
            <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 people landscapes sale">
                <div class="project-single" data-aos="fade-right">
                    <div class="project-inner project-head">
                        <div class="homes">
                            <!-- homes img -->
                            <a href="single-property-1.html" class="homes-img">
                                <div class="homes-tag button alt sale">For Sale</div>
                                <img src="images/blog/b-1.jpg" alt="home-1" class="img-responsive">
                            </a>
                        </div>
                        <div class="button-effect">
                            <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                            <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                            <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                        </div>
                    </div>
                    <!-- homes content -->
                    <div class="homes-content">
                        <!-- homes address -->
                        <h3><a href="single-property-1.html">Real Luxury Family House Villa</a></h3>
                        <p class="homes-address mb-3">
                            <a href="single-property-1.html">
                                <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South, NYC</span>
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
                        <div class="price-properties footer pt-3 pb-0">
                            <h3 class="title mt-3">
                                <a href="single-property-1.html">$ 150,000</a>
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
            <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 people landscapes rent no-pb">
                <div class="project-single no-mb" data-aos="fade-left">
                    <div class="project-inner project-head">
                        <div class="homes">
                            <!-- homes img -->
                            <a href="single-property-1.html" class="homes-img">
                                <div class="homes-tag button alt featured">Featured</div>
                                <div class="homes-tag button sale rent">For Rent</div>
                                <img src="images/feature-properties/fp-10.jpg" alt="home-1" class="img-responsive">
                            </a>
                        </div>
                        <div class="button-effect">
                            <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                            <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                            <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                        </div>
                    </div>
                    <!-- homes content -->
                    <div class="homes-content">
                        <!-- homes address -->
                        <h3><a href="single-property-1.html">Real Luxury Family House Villa</a></h3>
                        <p class="homes-address mb-3">
                            <a href="properties-details.html">
                                <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South, NYC</span>
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
                        <div class="price-properties footer pt-3 pb-0">
                            <h3 class="title mt-3">
                                <a href="single-property-1.html">$ 150,000</a>
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
            <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 people sale no-pb">
                <div class="project-single no-mb" data-aos="fade-right">
                    <div class="project-inner project-head">
                        <div class="homes">
                            <!-- homes img -->
                            <a href="single-property-1.html" class="homes-img">
                                <div class="homes-tag button alt featured">Featured</div>
                                <div class="homes-tag button alt sale">For Sale</div>
                                <img src="images/feature-properties/fp-11.jpg" alt="home-1" class="img-responsive">
                            </a>
                        </div>
                        <div class="button-effect">
                            <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                            <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                            <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                        </div>
                    </div>
                    <!-- homes content -->
                    <div class="homes-content">
                        <!-- homes address -->
                        <h3><a href="single-property-1.html">Real Luxury Family House Villa</a></h3>
                        <p class="homes-address mb-3">
                            <a href="single-property-1.html">
                                <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South, NYC</span>
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
                        <div class="price-properties footer pt-3 pb-0">
                            <h3 class="title mt-3">
                                <a href="single-property-1.html">$ 150,000</a>
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
            <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 it2 web rent no-pb">
                <div class="project-single no-mb last" data-aos="fade-left">
                    <div class="project-inner project-head">
                        <div class="homes">
                            <!-- homes img -->
                            <a href="single-property-1.html" class="homes-img">
                                <div class="homes-tag button sale rent">For Rent</div>
                                <img src="images/feature-properties/fp-12.jpg" alt="home-1" class="img-responsive">
                            </a>
                        </div>
                        <div class="button-effect">
                            <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                            <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                            <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                        </div>
                    </div>
                    <!-- homes content -->
                    <div class="homes-content">
                        <!-- homes address -->
                        <h3><a href="single-property-1.html">Real Luxury Family House Villa</a></h3>
                        <p class="homes-address mb-3">
                            <a href="single-property-1.html">
                                <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South, NYC</span>
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
                        <div class="price-properties footer pt-3 pb-0">
                            <h3 class="title mt-3">
                                <a href="single-property-1.html">$ 150,000</a>
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
        </div>
        <div class="bg-all">
            <a href="properties-full-grid-1.html" class="btn btn-outline-light">Xem thêm</a>
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
