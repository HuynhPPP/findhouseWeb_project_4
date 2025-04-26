@extends('front.poster.poster_dashboard')
@section('poster')
    <title>Đăng tin</title>
    <link rel="stylesheet" href="{{ asset('front/css/poster_post_view.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />

    <style>
        .custom-select-box {
            position: relative;
            width: 100%;
        }

        .custom-select-price {
            width: 130px;
        }

        .selected-option {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #fff;
            cursor: pointer;
        }

        .dropdown-options {
            display: none;
            position: absolute;
            width: 100%;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
        }

        .option {
            padding: 10px;
            cursor: pointer;
        }

        .option:hover {
            background: #f0f0f0;
        }

        .search-box {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 5px;
            font-size: 14px;
            outline: none;
        }

        .error-message {
            color: red;
            font-size: 15px;
            margin-top: 3px;
        }
    </style>

    <div class="col-lg-9 col-md-12 col-xs-12 royal-add-property-area section_100 pl-0 user-dash2">
        <form action="{{ route('poster.post.store') }}" method="post" enctype="multipart/form-data"
            style="margin-right: 50px !important;">
            @csrf
            <!-- Information common -->
            <div class="single-add-property mt-5">
                <h3>Thông tin mô tả</h3>
                <div class="property-form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label for="title">Tiêu đề</label>
                                <input type="text" name="title" id="title" placeholder=""
                                    value="{{ old('title') }}">
                                @error('title')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label for="description">Nội dung mô tả</label>
                                <textarea class="textarea" id="description" name="description" placeholder="">
                                    {{ old('description') }}
                                </textarea>
                                @error('description')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>
                    </div>
                    @php
                        $categories = App\Models\Category::get();
                    @endphp
                    <div class="row">
                        <div class="col-lg-4 col-md-12 dropdown faq-drop">
                            <div class="form-group mb-3">
                                <label for="province">Loại chuyên mục</label>
                                <select class="form-control" name="category_id">
                                    <option selected="" disabled>-- Chọn loại chuyên mục --</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label for="gia_thue">Giá cho thuê <span class="text-danger">(*)</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="price" min="0" step="1"
                                        id="rental_price" placeholder="Nhập giá" style="height: 50px;"
                                        value="{{ old('price') }}">
                                    <div class="input-group-append">
                                        <select id="rental_unit" class="custom-select-price">
                                            <option value="đồng/tháng">đồng/tháng</option>
                                            <option value="đồng/m2/tháng">đồng/m&sup2/tháng</option>
                                        </select>
                                    </div>
                                </div>
                                <p>Nhập đầy đủ số, ví dụ 1 triệu thì nhập là 1000000</p>
                                <p id="price_in_words" class="text-success"></p>
                            </div>
                            @error('price')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label for="area">Diện tích <span class="text-danger">(*)</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="area" name="area"
                                        placeholder="Nhập diện tích" style="height: 50px;" value="{{ old('area') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">m²</span>
                                    </div>
                                </div>
                            </div>
                            @error('area')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Images -->
            <div class="single-add-property">
                <h3>Hình ảnh</h3>
                <div class="property-form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Khu vực kéo thả hoặc nhấn để tải ảnh -->
                            <div class="drop-zone" id="dropZone">
                                <p> Kéo thả ảnh vào đây hoặc <b>Nhấn để chọn ảnh</b></p>
                                <input type="file" id="image" name="images[]" multiple style="display: none;" />
                            </div>

                            <!-- Hiển thị ảnh xem trước -->
                            <div class="image-preview" id="imagePreview"></div>
                            @error('images')
                                <p class="error-message">{{ $message }}</p>
                            @enderror

                            <!-- Hiển thị lỗi cho images -->
                            @if ($errors->has('images') || $errors->has('images.*'))
                                <div class="error-message">
                                    <!-- Hiển thị lỗi tổng thể (images.max) -->
                                    @if ($errors->has('images'))
                                        <p class="error-message">{{ $errors->first('images') }}</p>
                                    @endif

                                    <!-- Hiển thị lỗi từng file (images.*) nhưng không lặp lại -->
                                    @php
                                        $uniqueImageErrors = [];
                                        foreach ($errors->get('images.*') as $imageErrors) {
                                            foreach ($imageErrors as $error) {
                                                if (!in_array($error, $uniqueImageErrors)) {
                                                    $uniqueImageErrors[] = $error;
                                                }
                                            }
                                        }
                                    @endphp
                                    @foreach ($uniqueImageErrors as $error)
                                        <p class="error-message">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video -->
            <div class="single-add-property">
                <h3>Video</h3>
                <div class="property-form-group">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Nhập link từ YouTube hoặc TikTok -->
                            <div class="video-link-container">
                                <label for="videoLink">Video Link (Youtube)</label>
                                <input type="text" id="videoLink" name="video_url" class="form-control"
                                    placeholder="Dán link video vào đây...">
                                <p class="text-muted">
                                    📌 <strong>Lưu ý:</strong> Chỉ hỗ trợ YouTube & TikTok. Vui lòng nhập đúng định dạng
                                    sau:<br>
                                    <br>
                                    🔹 <strong>Đối với YouTube:</strong><br>
                                    - <code>https://www.youtube.com/watch?v=<b>xxxxxxxxxxx</b></code> ✅<br>
                                    - <code>https://youtu.be/<b>xxxxxxxxxxx</b></code> ✅<br>

                                    {{-- 🔹 <strong>Đối với TikTok:</strong><br>
                                    - <code>https://www.tiktok.com/@<b>username</b>/video/<b>xxxxxxxxxxx</b></code> ✅<br> --}}
                                    <br>
                                    🚫 <strong>Không hỗ trợ</strong>:<br>
                                    - Các link rút gọn hoặc link nhúng không đúng định dạng.<br>
                                </p>
                            </div>

                            <!-- Hiển thị video nhúng -->
                            <div id="embeddedVideoContainer" style="display: none; margin-top: 15px;">
                                <div id="embeddedVideo"></div> <!-- Khu vực hiển thị video -->
                            </div>
                            @error('video_url')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location -->
            <div class="single-add-property">
                <h3>Khu vực</h3>
                <div class="property-form-group">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-3">
                                <label for="province">Tỉnh/Thành phố</label>
                                <select id="province" class="form-control" name="province">
                                    <option selected="" disabled>-- Chọn Tỉnh/Thành phố --</option>
                                </select>
                                <input type="hidden" id="province_name" name="province_name"
                                    value="{{ old('province_name') }}">
                                @error('province')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="district">Quận/Huyện</label>
                                <select id="district" class="form-control" name="district">
                                    <option selected="" disabled>-- Chọn Quận/Huyện --</option>
                                </select>
                                <input type="hidden" id="district_name" name="district_name"
                                    value="{{ old('district_name') }}">
                                @error('district')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="wards">Phường/Xã</label>
                                <select id="wards" class="form-control" name="ward">
                                    <option selected="" disabled>-- Chọn Phường/Xã --</option>
                                </select>
                                <input type="hidden" id="ward_name" name="ward_name" value="{{ old('ward_name') }}">
                                @error('ward')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <p>
                                <label for="country">Đường/Phố</label>
                                <input type="text" name="street" placeholder="Nhập tên đường/phố" id="country"
                                    value="{{ old('street') }}">
                                @error('street')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <p class="no-mb first">
                                <label for="latitude">Số nhà</label>
                                <input type="text" name="house_number" placeholder="Nhập số nhà" id="latitude"
                                    value="{{ old('house_number') }}">
                                @error('house_number')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <p class="no-mb last">
                                <label for="longitude">Địa chỉ</label>
                                <input type="text" name="address" placeholder="" id="address" readonly
                                    value="{{ old('address') }}">
                                @error('address')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12 col-md-12">
                            <button type="button" id="find-location" class="btn btn-primary">Tìm vị trí trên bản
                                đồ</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="single-add-property">
                <h3>Bản đồ</h3>
                <div id="map"></div>
            </div>

            @php
                $id = Auth::user()->id;
                $profileData = App\Models\User::find($id);
            @endphp

            <!-- Profile -->
            <div class="single-add-property">
                <h3>thông tin liên hệ</h3>
                <div class="property-form-group">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <p>
                                <label for="con-name">Họ tên</label>
                                <input type="text" id="con-name" value="{{ $profileData->name }}" readonly>
                            </p>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <p class="no-mb first">
                                <label for="con-email">Email</label>
                                <input type="email" id="con-email" value="{{ $profileData->email }}" readonly>
                            </p>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <p class="no-mb last">
                                <label for="con-phn">Số điện thoại</label>
                                <input type="text" id="con-phn" value="{{ $profileData->phone }}" readonly>
                            </p>
                        </div>
                    </div>
                    <div class="add-property-button pt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="prperty-submit-button">
                                    <button type="submit">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('customJs')
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
    <script src="{{ asset('front/leaflet/map_post_view.js') }}"></script>

    <!-- Lấy API tỉnh thành -->
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
                $("#district").html('<option selected="" disabled>-- Chọn Quận / Huyện --</option>')
                    .niceSelect(
                        'update');
                $("#wards").html('<option selected="" disabled>-- Chọn Phường / Xã --</option>').niceSelect(
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

    <!-- Xử lý video -->
    <script>
        document.getElementById('videoLink').addEventListener('input', function() {
            const url = this.value.trim();
            const embeddedContainer = document.getElementById('embeddedVideoContainer');
            const embeddedVideo = document.getElementById('embeddedVideo');

            // Xóa nội dung cũ trước khi cập nhật
            embeddedVideo.innerHTML = "";
            embeddedContainer.style.display = "none";

            if (url.includes("youtube.com/watch?v=") || url.includes("youtu.be/")) {
                // Xử lý link YouTube
                let videoId = url.split("v=")[1]?.split("&")[0] || url.split("youtu.be/")[1];
                embeddedVideo.innerHTML =
                    `<iframe width="100%" height="600" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
                embeddedContainer.style.display = "block";
            } else if (url.includes("tiktok.com/")) {
                // Lấy video_id từ URL TikTok
                const match = url.match(/video\/(\d+)/);
                const videoId = match ? match[1] : null;

                if (videoId) {
                    // Nhúng TikTok video với đúng `data-video-id`
                    embeddedVideo.innerHTML = `
                        <blockquote class="tiktok-embed" cite="${url}" data-video-id="${videoId}" style="max-width: 100%;">
                            <section></section>
                        </blockquote>
                    `;
                    embeddedContainer.style.display = "block";

                    // Kiểm tra xem script TikTok đã có chưa, nếu chưa thì tải
                    if (!window.tiktokEmbedLoaded) {
                        var script = document.createElement('script');
                        script.src = "https://www.tiktok.com/embed.js";
                        script.async = true;
                        script.onload = () => {
                            window.tiktokEmbedLoaded = true;
                        };
                        document.body.appendChild(script);
                    } else if (window.tiktokEmbedLoad) {
                        window.tiktokEmbedLoad(); // Tải lại video nếu script đã được nạp trước đó
                    }
                }
            }
        });
    </script>

    <!-- Xử lý ảnh -->
    <script>
        $(document).ready(function() {
            let dropZone = $("#dropZone");
            let inputFile = $("#image");
            let previewContainer = $("#imagePreview");

            // Khi click vào khu vực kéo thả thì mở hộp thoại chọn ảnh
            let isTriggering = false;

            dropZone.on("click", function(e) {
                if (!isTriggering) {
                    isTriggering = true;
                    inputFile.trigger("click");

                    // Đặt lại trạng thái sau khi chọn file
                    setTimeout(() => isTriggering = false, 500);
                }
            });

            // Khi chọn ảnh từ input file
            inputFile.on("change", function(e) {
                let files = e.target.files;
                previewImages(files);
            });

            // Kéo thả ảnh vào khu vực
            dropZone.on("dragover", function(e) {
                e.preventDefault();
                dropZone.addClass("dragover");
            });

            dropZone.on("dragleave", function() {
                dropZone.removeClass("dragover");
            });

            dropZone.on("drop", function(e) {
                e.preventDefault();
                dropZone.removeClass("dragover");

                let files = e.originalEvent.dataTransfer.files;
                previewImages(files);
            });

            // Hiển thị ảnh xem trước và thêm nút xóa ảnh
            function previewImages(files) {
                $.each(files, function(index, file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let imgContainer = $("<div>").css({
                            position: "relative",
                            display: "inline-block",
                        });

                        let img = $("<img>").attr("src", e.target.result).addClass("preview-img");


                        let removeBtn = $("<button>")
                            .addClass("remove-img")
                            .html("&times;") // Dấu x
                            .click(function() {
                                imgContainer.remove(); // Xóa ảnh khi nhấn x
                            });

                        imgContainer.append(img).append(removeBtn);
                        previewContainer.append(imgContainer);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>

    <!-- Đổi thành tiền bằng chữ -->
    <script>
        document.getElementById("rental_price").addEventListener("input", updatePriceInWords);
        document.getElementById("rental_unit").addEventListener("change", updatePriceInWords);

        function updatePriceInWords() {
            let amount = document.getElementById("rental_price").value.replace(/\./g, "").trim();
            let unit = document.getElementById("rental_unit").value;
            let words = numberToWords(parseInt(amount));
            if (words) {
                document.getElementById("price_in_words").innerText = words + " " + unit;
            } else {
                document.getElementById("price_in_words").innerText = "";
            }
        }

        function numberToWords(number) {
            if (isNaN(number) || number <= 0) return "";

            let ones = ["", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín"];
            let tens = ["", "mười", "hai mươi", "ba mươi", "bốn mươi", "năm mươi", "sáu mươi", "bảy mươi", "tám mươi",
                "chín mươi"
            ];
            let thousands = ["", "nghìn", "triệu", "tỷ"];

            let numStr = number.toString().split("").reverse().join("");
            let wordArray = [];

            for (let i = 0; i < numStr.length; i += 3) {
                let numPart = numStr.substr(i, 3).split("").reverse().join("");
                let partWord = threeDigitToWords(parseInt(numPart));
                if (partWord) {
                    wordArray.unshift(partWord + " " + thousands[i / 3]);
                }
            }

            return wordArray.join(" ").trim();
        }

        function threeDigitToWords(num) {
            if (num === 0) return "";

            let ones = ["", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín"];
            let tens = ["", "mười", "hai mươi", "ba mươi", "bốn mươi", "năm mươi", "sáu mươi", "bảy mươi", "tám mươi",
                "chín mươi"
            ];

            let str = "";
            if (num >= 100) {
                str += ones[Math.floor(num / 100)] + " trăm ";
                num %= 100;
            }
            if (num >= 10) {
                str += tens[Math.floor(num / 10)] + " ";
                num %= 10;
            }
            if (num > 0) {
                str += ones[num];
            }
            return str.trim();
        }
    </script>

    <!-- Chỉ cho phép nhập số -->
    <script>
        document.getElementById("rental_price").addEventListener("keypress", function(event) {
            if (event.key === "." || event.key === ",") {
                event.preventDefault(); // Ngăn nhập dấu "." hoặc ","
            }
            if (!/^[0-9]+$/.test(event.key)) {
                event.preventDefault(); // Chỉ cho phép nhập số
            }
        });

        document.getElementById("rental_price").addEventListener("input", function() {
            this.value = this.value.replace(/[^0-9]/g, ""); // Xóa toàn bộ ký tự không phải số
        });
    </script>

    {{-- Lấy vị trí trên bản đồ --}}
    <script>
        $(document).ready(function() {

            // Hàm lấy địa chỉ đầy đủ và cập nhật trường address
            function updateAddressField() {
                let houseNumber = $('input[name="house_number"]').val().trim();
                let street = $('input[name="street"]').val().trim();
                let ward = $('#wards option:selected').text().trim();
                let district = $('#district option:selected').text().trim();
                let province = $('#province option:selected').text().trim();

                // Kiểm tra giá trị value của select để đảm bảo không lấy placeholder
                let wardValue = $('#wards').val();
                let districtValue = $('#district').val();
                let provinceValue = $('#province').val();

                // Tạo mảng chứa các thành phần địa chỉ hợp lệ
                let addressParts = [];

                if (houseNumber) {
                    addressParts.push(houseNumber);
                }
                if (street) {
                    addressParts.push(street);
                }
                if (ward && ward !== "-- Chọn Phường/Xã --" && wardValue) {
                    addressParts.push(ward);
                }
                if (district && district !== "-- Chọn Quận/Huyện --" && districtValue) {
                    addressParts.push(district);
                }
                if (province && province !== "-- Chọn Tỉnh/Thành phố --" && provinceValue) {
                    addressParts.push(province);
                }

                // Ghép các thành phần thành chuỗi địa chỉ
                let address = addressParts.join(", ");

                if (address) {
                    address += ", Việt Nam";
                }

                // Cập nhật trường address
                $('input[name="address"]').val(address);
            }

            // Cập nhật địa chỉ khi các trường thay đổi
            $('input[name="house_number"], input[name="street"], #wards, #district, #province').on('change',
                function() {
                    updateAddressField();
                });

            // Gọi ngay khi trang tải để cập nhật địa chỉ ban đầu (nếu có old values)
            updateAddressField();

            // Xử lý khi nhấn nút tìm vị trí
            $("#find-location").click(function(event) {
                event.preventDefault();

                let fullAddress = $('input[name="address"]').val().trim();
                let simplifiedAddress = fullAddress.replace(/^.*?, /, ''); // loại bỏ phần số nhà

                if (!simplifiedAddress || simplifiedAddress === "Việt Nam") {
                    Swal.fire({
                        title: "Vui lòng nhập đầy đủ địa chỉ!",
                        icon: "error",
                    });
                    return;
                }

                tryGeocodeVariants(fullAddress, simplifiedAddress, function(coords) {
                    if (coords) {
                        updateMap(coords.lat, coords.lon);
                    }
                });
            });

        });
    </script>
@endsection
