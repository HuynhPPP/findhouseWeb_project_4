<section class="feature-categories bg-white rec-pro">
    <div class="container-fluid">
        <div class="sec-title">
            <h2>Các thành phố lớn</h2>
            <p>Bạn cần tìm kiếm chỗ ở những thành phố lớn.</p>
        </div>
        <div class="row">
            @php
                $provinces = [
                    'Thành phố Hồ Chí Minh' => 'TPHCM.jpg',
                    'Thành phố Hà Nội' => 'HANOI_KhueVanCac.jpg',
                    'Thành phố Hải Phòng' => 'THHP.jpg',
                    'Thành phố Đà Nẵng' => 'TPDN.jpg',
                    'Tỉnh Thừa Thiên Huế' => 'TPHUE.jpg',
                    'Tỉnh Bình Dương' => 'TPBD.jpg',
                    'Tỉnh Bà Rịa - Vũng Tàu' => 'BRVT.jpg',
                    'Thành phố Cần Thơ' => 'TPCT.jpg',
                ];
            @endphp

            @foreach ($provinces as $province => $image)
                <div class="col-xl-3 col-lg-6 col-sm-6" data-aos="fade-up">
                    <div class="small-category-2">
                        <div class="small-category-2-thumb">
                            <a href="{{ route('properties.by.province', ['province' => $province]) }}">
                                <img src="{{ asset('front/images/popular-places/' . $image) }}"
                                    alt="{{ $province }}">
                            </a>
                        </div>
                        <div class="sc-2-detail">
                            <h4 class="sc-jb-title">
                                <a
                                    href="{{ route('properties.by.province', ['province' => $province]) }}">{{ $province }}</a>
                            </h4>
                            <span>{{ $provinceCounts[$province] ?? 0 }} bài đăng</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- /row -->
    </div>
</section>
