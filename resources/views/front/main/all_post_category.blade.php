@extends('front.SecondPage')
@section('home_2')
@section('title')
    Danh sách tin đăng theo danh mục "{{ $category->category_name }}
@endsection

<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('front/css/main_ui/all_post.css') }}">

<!-- START SECTION PROPERTIES LISTING -->
<section class="properties-list featured portfolio blog">
    <div class="container">
        <section class="headings-2 pt-0 pb-0">
            <div class="pro-wrapper">
                <div class="detail-wrapper-body">
                    <div class="listing-title-bar">
                        <div class="text-heading text-left">
                            <p><a href="index.html">Trang chủ </a> &nbsp;/&nbsp;
                                <span>{{ $category->category_name }}</span>
                            </p>
                        </div>
                        <h3>Danh sách tin đăng theo danh mục "{{ $category->category_name }}"</h3>
                        <input type="hidden" id="current-category-id" value="{{ $category->id }}">
                    </div>
                </div>
            </div>
        </section>
        <!-- Search Form -->
        <div class="col-12 px-0 parallax-searchs">
            <div class="banner-search-wrap">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tabs_1">
                        <form action="{{ route('search.post') }}" method="POST">
                            @csrf
                            <div class="rld-main-search">
                                <div class="row">
                                    <div class="rld-single-input">
                                        <input type="text" placeholder="Nhập từ khoá...">
                                    </div>
                                    <div class="rld-single-select ml-22">
                                        <select class="select single-select" name="category">
                                            <option selected disabled>-- Danh mục --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="rld-single-select">
                                        <select class="select single-select mr-0" name="province" id="province">
                                            <option selected value="0">Toàn quốc</option>
                                        </select>
                                        <input type="hidden" id="provinceName" name="provinceName">
                                    </div>
                                    <div class="dropdown-filter" data-toggle="modal" data-target="#filterModal">
                                        <span style="width: 235px">Bộ lọc</span>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                        <button type="submit" class="btn btn-yellow">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Search Form -->
        <section class="headings-2 pt-0">
            <div class="pro-wrapper">
                <div class="detail-wrapper-body">
                    <div class="listing-title-bar">
                        <div class="text-heading text-left">
                            <p class="font-weight-bold mb-0 mt-2">
                                <label
                                    class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3"
                                    for="inputGroupSelect01"><i class="fas fa-align-left fs-16 pr-2"></i>Có
                                    {{ $posts_category->total() }} tin đăng cho thuê
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center">
                    <div class="input-group border rounded input-group-lg w-auto mr-4">
                        <label
                            class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3"
                            for="inputGroupSelect01"><i class="fas fa-align-left fs-16 pr-2"></i>Sắp xếp theo:</label>
                        <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby"
                            id="sortby" name="sortby">
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá (thấp
                                đến cao)</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá (cao
                                đến thấp)</option>
                        </select>
                    </div>
                </div>
            </div>
        </section>
        <!-- Block heading end -->
        <div class="row featured portfolio-items" id="post-list-category">
            @include('front.main.sort_page.posts_list_sort_category', ['posts' => $posts_category])
        </div>
        <!-- Phân trang -->
        <div class="d-flex justify-content-end mt-3" id="pagination">
            {{ $posts_category->appends(request()->all())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
<!-- END SECTION PROPERTIES LISTING -->
@endsection

<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
<div class="modal-dialog" style="max-width: 70%;">
    <div class="modal-content" style="margin-top: 120px;">
        <div class="modal-header">
            <h5 class="modal-title" id="filterModalLabel">Bộ lọc tìm
                kiếm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('filter.post') }}" method="POST" id="filterForm">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinceNew">Chọn Tỉnh/Thành</label>
                            <select id="provinceNew" name="province" class="form-control">
                                <option selected disabled>-- Chọn Tỉnh/Thành --</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="districtNew">Chọn Quận/Huyện</label>
                            <select id="districtNew" name="district" class="form-control">
                                <option selected disabled>-- Chọn Quận/Huyện --</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="wardsNew">Chọn Phường/Xã</label>
                            <select id="wardsNew" name="ward" class="form-control">
                                <option selected disabled>-- Chọn Phường/Xã --</option>
                            </select>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="province_name" name="province_name">
                <input type="hidden" id="district_name" name="district_name">
                <input type="hidden" id="ward_name" name="ward_name">


                <div class="form-group filter-section category-group">
                    <label class="filter-label">Danh mục cho thuê</label>
                    <div class="filter-group">
                        <button type="button" class="filter-btn active" data-value="all">Tất cả</button>
                        @foreach ($categories as $category)
                            <button type="button" class="filter-btn"
                                data-value="{{ $category->id }}">{{ $category->category_name }}</button>
                        @endforeach
                    </div>
                </div>

                <!-- Khoảng giá -->
                <div class="form-group filter-section price-group">
                    <label class="filter-label">Khoảng giá</label>
                    <div class="filter-group">
                        <button type="button" class="filter-btn active" data-value="all">Tất cả</button>
                        <button type="button" class="filter-btn" data-value="under-1m">Dưới 1 triệu</button>
                        <button type="button" class="filter-btn" data-value="1-2m">1 - 2 triệu</button>
                        <button type="button" class="filter-btn" data-value="2-3m">2 - 3 triệu</button>
                        <button type="button" class="filter-btn" data-value="3-5m">3 - 5 triệu</button>
                        <button type="button" class="filter-btn" data-value="5-7m">5 - 7 triệu</button>
                        <button type="button" class="filter-btn" data-value="7-10m">7 - 10 triệu</button>
                        <button type="button" class="filter-btn" data-value="10-15m">10 - 15 triệu</button>
                        <button type="button" class="filter-btn" data-value="over-15m">Trên 15 triệu</button>
                    </div>
                </div>

                <!-- Khoảng diện tích -->
                <div class="form-group filter-section area-group">
                    <label class="filter-label">Khoảng diện tích</label>
                    <div class="filter-group">
                        <button type="button" class="filter-btn active" data-value="all">Tất cả</button>
                        <button type="button" class="filter-btn" data-value="under-20m2">Dưới 20m²</button>
                        <button type="button" class="filter-btn" data-value="20-30m2">Từ 20m² - 30m²</button>
                        <button type="button" class="filter-btn" data-value="30-50m2">Từ 30m² - 50m²</button>
                        <button type="button" class="filter-btn" data-value="50-70m2">Từ 50m² - 70m²</button>
                        <button type="button" class="filter-btn" data-value="70-90m2">Từ 70m² - 90m²</button>
                        <button type="button" class="filter-btn" data-value="over-90m2">Trên 90m²</button>
                    </div>
                </div>

                <input type="hidden" id="priceRange" name="price_range" value="all">
                <input type="hidden" id="areaRange" name="area_range" value="all">
                <input type="hidden" id="categoryRange" name="category_id" value="all">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-yellow" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-yellow">Áp
                    dụng bộ
                    lọc</button>
            </div>
        </form>
    </div>
</div>
</div>

@section('customJs')
<script>
    $(document).ready(function() {
        let oldProvince = "{{ old('province') }}";
        let oldDistrict = "{{ old('district') }}";
        let oldWard = "{{ old('ward') }}";

        // Load danh sách tỉnh
        $.getJSON('/api/proxy/provinces', function(data_tinh) {
            if (data_tinh.error === 0) {
                $.each(data_tinh.data, function(key_tinh, val_tinh) {
                    let selected = (val_tinh.id == oldProvince) ? "selected" : "";
                    $("#province").append('<option value="' + val_tinh.id + '" ' + selected +
                        '>' + val_tinh.full_name + '</option>');
                });

                $("#province").niceSelect('update');

                if (oldProvince) {
                    $("#province_name").val("{{ old('province_name') }}");
                    loadDistricts(oldProvince, oldDistrict, oldWard);
                }
            }
        });

        // Khi chọn tỉnh
        $("#province").change(function() {
            let provinceId = $(this).val();
            let provinceName = $("#province option:selected").text();
            $("#province_name").val(provinceName);
            $("#district").html('<option selected disabled>-- Chọn Quận / Huyện --</option>')
                .niceSelect(
                    'update');
            $("#wards").html('<option selected disabled>-- Chọn Phường / Xã --</option>').niceSelect(
                'update');

            if (provinceId) {
                loadDistricts(provinceId, null, null);
            }
        });

        // Load danh sách quận/huyện
        function loadDistricts(provinceId, selectedDistrict, selectedWard) {
            $.getJSON('/api/proxy/districts/' + provinceId, function(data_quan) {
                if (data_quan.error === 0) {
                    $.each(data_quan.data, function(key_quan, val_quan) {
                        let selected = (val_quan.id == selectedDistrict) ? "selected" : "";
                        $("#district").append('<option value="' + val_quan.id + '" ' +
                            selected + '>' + val_quan.full_name + '</option>');
                    });

                    $("#district").niceSelect('update');

                    if (selectedDistrict) {
                        $("#district_name").val("{{ old('district_name') }}");
                        loadWards(selectedDistrict, selectedWard);
                    }
                }
            });
        }

        // Khi chọn quận/huyện
        $("#district").change(function() {
            let districtId = $(this).val();
            let districtName = $("#district option:selected").text();
            $("#district_name").val(districtName);
            $("#wards").html('<option selected="" disabled>-- Chọn Phường / Xã --</option>').niceSelect(
                'update');

            if (districtId) {
                loadWards(districtId, null);
            }
        });

        // Load danh sách phường/xã
        function loadWards(districtId, selectedWard) {
            $.getJSON('/api/proxy/wards/' + districtId, function(data_phuong) {
                if (data_phuong.error === 0) {
                    $.each(data_phuong.data, function(key_phuong, val_phuong) {
                        let selected = (val_phuong.id == selectedWard) ? "selected" : "";
                        $("#wards").append('<option value="' + val_phuong.id + '" ' + selected +
                            '>' + val_phuong.full_name + '</option>');
                    });

                    $("#wards").niceSelect('update');

                    if (selectedWard) {
                        $("#ward_name").val("{{ old('ward_name') }}");
                    }
                }
            });
        }

        // Khi chọn xã
        $("#wards").change(function() {
            let wardName = $("#wards option:selected").text();
            $("#ward_name").val(wardName);
        });
    });
</script>

<script>
    $(document).ready(function() {
        let oldProvince = "{{ old('province') }}";
        let oldDistrict = "{{ old('district') }}";
        let oldWard = "{{ old('ward') }}";

        // Load danh sách tỉnh
        $.getJSON('/api/proxy/provinces', function(data_tinh) {
            if (data_tinh.error === 0) {
                $("#provinceNew").empty().append(
                    '<option selected disabled>-- Chọn Tỉnh/Thành --</option>');
                $.each(data_tinh.data, function(key_tinh, val_tinh) {
                    let selected = (val_tinh.id == oldProvince) ? "selected" : "";
                    $("#provinceNew").append('<option value="' + val_tinh.id + '" ' + selected +
                        '>' + val_tinh.full_name + '</option>');
                });

                $("#provinceNew").niceSelect('update');

                if (oldProvince) {
                    $("#province_name").val("{{ old('province_name') }}");
                    loadDistricts(oldProvince, oldDistrict, oldWard);
                }
            }
        });

        // Khi chọn tỉnh
        $("#provinceNew").change(function() {
            let provinceId = $(this).val();
            let provinceName = $("#provinceNew option:selected").text();
            $("#province_name").val(provinceName);

            $("#districtNew").empty().append(
                '<option selected disabled>-- Chọn Quận / Huyện --</option>').niceSelect('update');
            $("#wardsNew").empty().append('<option selected disabled>-- Chọn Phường / Xã --</option>')
                .niceSelect('update');

            if (provinceId) {
                loadDistricts(provinceId, null, null);
            }
        });

        // Load danh sách quận/huyện
        function loadDistricts(provinceId, selectedDistrict, selectedWard) {
            $.getJSON('/api/proxy/districts/' + provinceId, function(data_quan) {
                if (data_quan.error === 0) {
                    $("#districtNew").empty().append(
                        '<option selected disabled>-- Chọn Quận / Huyện --</option>');
                    $.each(data_quan.data, function(key_quan, val_quan) {
                        let selected = (val_quan.id == selectedDistrict) ? "selected" : "";
                        $("#districtNew").append('<option value="' + val_quan.id + '" ' +
                            selected + '>' + val_quan.full_name + '</option>');
                    });

                    $("#districtNew").niceSelect('update');

                    if (selectedDistrict) {
                        $("#district_name").val("{{ old('district_name') }}");
                        loadWards(selectedDistrict, selectedWard);
                    }
                }
            });
        }

        // Khi chọn quận/huyện
        $("#districtNew").change(function() {
            let districtId = $(this).val();
            let districtName = $("#districtNew option:selected").text();
            $("#district_name").val(districtName);

            $("#wardsNew").empty().append('<option selected disabled>-- Chọn Phường / Xã --</option>')
                .niceSelect('update');

            if (districtId) {
                loadWards(districtId, null);
            }
        });

        // Load danh sách phường/xã
        function loadWards(districtId, selectedWard) {
            $.getJSON('/api/proxy/wards/' + districtId, function(data_phuong) {
                if (data_phuong.error === 0) {
                    $("#wardsNew").empty().append(
                        '<option selected disabled>-- Chọn Phường / Xã --</option>');
                    $.each(data_phuong.data, function(key_phuong, val_phuong) {
                        let selected = (val_phuong.id == selectedWard) ? "selected" : "";
                        $("#wardsNew").append('<option value="' + val_phuong.id + '" ' +
                            selected + '>' + val_phuong.full_name + '</option>');
                    });

                    $("#wardsNew").niceSelect('update');

                    if (selectedWard) {
                        $("#ward_name").val("{{ old('ward_name') }}");
                    }
                }
            });
        }

        // Khi chọn xã
        $("#wardsNew").change(function() {
            let wardName = $("#wardsNew option:selected").text();
            $("#ward_name").val(wardName);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#province").change(function() {
            let provinceId = $(this).val();
            let provinceName = $("#province option:selected").text();
            $("#provinceName").val(provinceName); // Gán giá trị tên tỉnh vào input hidden
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#provinceNew").change(function() {
            let provinceId = $(this).val();
            let provinceName = $("#provinceNew option:selected").text();
            $("#province_name").val(provinceName); // Gán giá trị tên tỉnh vào input hidden
        });

        $("#districtNew").change(function() {
            let districtId = $(this).val();
            let districtName = $("#districtNew option:selected").text();
            $("#district_name").val(districtName); // Gán giá trị tên quận vào input hidden
        });

        $("#wardsNew").change(function() {
            let wardId = $(this).val();
            let wardName = $("#wardsNew option:selected").text();
            $("#ward_name").val(wardName); // Gán giá trị tên xã vào input hidden
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function handleFilterSelection(groupClass, inputId) {
            const buttons = document.querySelectorAll(`.${groupClass} button[data-value]`);
            const hiddenInput = document.getElementById(inputId);

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    // Hủy kích hoạt tất cả các nút khác trong nhóm
                    buttons.forEach(btn => btn.classList.remove('active'));

                    // Kích hoạt nút được chọn
                    this.classList.add('active');

                    // Cập nhật giá trị vào input ẩn
                    hiddenInput.value = this.getAttribute('data-value');

                    // In giá trị để kiểm tra
                    console.log(`Updated ${inputId}:`, hiddenInput.value);
                });
            });
        }

        // Áp dụng cho từng nhóm
        handleFilterSelection('price-group', 'priceRange');
        handleFilterSelection('area-group', 'areaRange');
        handleFilterSelection('category-group', 'categoryRange');

        // Kiểm tra giá trị trước khi submit form
        document.querySelector('#filterForm').addEventListener('submit', function(event) {
            console.log("Submitting form with:");
            console.log("price_range:", document.getElementById('priceRange').value);
            console.log("area_range:", document.getElementById('areaRange').value);
            console.log("category_id:", document.getElementById('categoryRange').value);
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Lấy trang hiện tại từ URL
        function getCurrentPage() {
            var urlParams = new URLSearchParams(window.location.search);
            return parseInt(urlParams.get('page')) || 1;
        }

        // Xử lý sự kiện thay đổi dropdown
        $('#sortby').on('change', function() {
            var sort = $(this).val();
            var currentPage = getCurrentPage();
            loadPosts(sort, currentPage);
        });

        // Xử lý click vào link phân trang
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = new URL($(this).attr('href'));
            var page = url.searchParams.get('page') || 1;
            var sort = $('#sortby').val() || '{{ request('sort', 'price_asc') }}';
            loadPosts(sort, page);
        });

        // Hàm load danh sách tin đăng
        function loadPosts(sort, page) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            var categoryId = $('#current-category-id').val();
            var ajaxUrl = '/posts/category/sort/' +
                categoryId; // Hoặc bạn dùng `route()` trên server và truyền ID

            console.log('AJAX URL: ' + ajaxUrl);

            $.ajax({
                url: ajaxUrl,
                type: 'GET',
                data: {
                    sort: sort,
                    page: page
                },
                success: function(response) {
                    $('#post-list-category').html(response.posts_html);
                    $('#pagination').html(response.pagination_html);
                    if ($.fn.selectpicker) {
                        $('#sortby').selectpicker('refresh');
                    }
                    var params = {
                        sort: sort,
                        page: page
                    };
                    var newUrl = window.location.pathname + '?' + $.param(params);
                    window.history.pushState({}, '', newUrl);
                },
                error: function(xhr) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Không thể tải danh sách tin đăng. Vui lòng thử lại!'
                    });
                }
            });
        }
    });
</script>
@endsection
