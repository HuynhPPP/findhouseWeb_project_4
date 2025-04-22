@extends('front.poster.poster_dashboard')
@section('poster')
    <title>{{ $post->title }}</title>
    <link rel="stylesheet" href="{{ asset('front/css/poster_post_view.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />


    <style>
        .custom-select-box {
            position: relative;
            width: 100%;
        }

        .custom-select-price {
            width: 120px;
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
    </style>

    <div class="col-lg-9 col-md-12 col-xs-12 royal-add-property-area section_100 pl-0 user-dash2">

        <form action="{{ route('poster.post.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $post->id }}">
            <input type="hidden" name="poster_name" value="{{ $post->user->name }}">

            <!-- Information common -->
            <div class="single-add-property mt-5">
                <h3>Thông tin mô tả</h3>
                <div class="property-form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label for="title">Tiêu đề <span class="text-danger">(*)</span></label>
                                <input type="text" name="title" id="title" placeholder=""
                                    value="{{ old('title', $post->title) }}">
                                @error('title')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label for="description">Nội dung mô tả <span class="text-danger">(*)</span></label>
                                <textarea class="textarea" id="description" name="description" placeholder="">
                                    {{ old('description', $post->description) }}
                                </textarea>
                                @error('description')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12 dropdown faq-drop">
                            <div class="form-group mb-3">
                                <label for="province">Loại chuyên mục <span class="text-danger">(*)</span></label>
                                <select class="form-control" name="category_id">
                                    <option selected="" disabled>-- Chọn loại chuyên mục --</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id', $post->category_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p style="color:red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label for="gia_thue">Giá cho thuê <span class="text-danger">(*)</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="price" min="0" step="1"
                                        id="rental_price" placeholder="Nhập giá" value="{{ old('price', $post->price) }}"
                                        style="height: 50px;">
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
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label for="area">Diện tích <span class="text-danger">(*)</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="area" name="area"
                                        placeholder="Nhập diện tích" value="{{ old('area', $post->area) }}"
                                        style="height: 50px;">
                                    <div class="input-group-append">
                                        <span class="input-group-text">m²</span>
                                    </div>
                                </div>
                            </div>
                            @error('area')
                                <p style="color:red">{{ $message }}</p>
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
                            <div class="image-preview" id="imagePreview">
                                @foreach ($images as $image)
                                    <div id="image-{{ $image->id }}" style="position: relative; display: inline-block;">
                                        <img src="{{ asset('upload/post_images/' . $image->image_url) }}"
                                            class="preview-img">
                                        <button class="remove-img delete-image"
                                            data-id="{{ $image->id }}">&times;</button>
                                    </div>
                                @endforeach
                            </div>

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
                            @error('images')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
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

                            @php
                                $video_url = $post->video_url ?? ''; // Lấy giá trị từ database, tránh lỗi nếu null
                                if (strpos($video_url, 'youtube.com/embed/') !== false) {
                                    $video_url_fixed = str_replace('embed/', 'watch?v=', $video_url);
                                } else {
                                    $video_url_fixed = $video_url;
                                }
                            @endphp

                            <div class="video-link-container">
                                <label for="videoLink">Video Link (Youtube/Tiktok)</label>
                                <input type="text" id="videoLink" name="video_url" class="form-control"
                                    placeholder="Dán link video vào đây..." value="{{ $video_url_fixed ?? '' }}">
                                <p class="text-muted">
                                    📌 <strong>Lưu ý:</strong> Chỉ hỗ trợ YouTube & TikTok. Vui lòng nhập đúng định dạng
                                    sau:<br>
                                    <br>
                                    🔹 <strong>Đối với YouTube:</strong><br>
                                    - <code>https://www.youtube.com/watch?v=<b>xxxxxxxxxxx</b></code> ✅<br>
                                    - <code>https://youtu.be/<b>xxxxxxxxxxx</b></code> ✅<br>
                                    <br>
                                    🔹 <strong>Đối với TikTok:</strong><br>
                                    - <code>https://www.tiktok.com/@<b>username</b>/video/<b>xxxxxxxxxxx</b></code> ✅<br>
                                    <br>
                                    🚫 <strong>Không hỗ trợ</strong>:<br>
                                    - Các link rút gọn hoặc link nhúng không đúng định dạng.<br>
                                </p>
                            </div>

                            <!-- Hiển thị video nhúng -->
                            <div id="embeddedVideoContainer" style="display: none; margin-top: 15px;">
                                <div id="embeddedVideo"></div> <!-- Khu vực hiển thị video -->
                            </div>
                            @error('video')
                                <p style="color:red">{{ $message }}</p>
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
                                    @if (!empty($post->province))
                                        <option selected>{{ $post->province }}</option>
                                    @else
                                        <option selected="" disabled>-- Chọn Tỉnh/Thành phố --</option>
                                    @endif
                                </select>
                                <input type="hidden" id="province_name" name="province_name"
                                    value="{{ old('province_name', $post->province) }}">
                                @error('province')
                                    <p style="color:red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="district">Quận/Huyện</label>
                                <select id="district" class="form-control" name="district">
                                    @if (!empty($post->district))
                                        <option selected>{{ $post->district }}</option>
                                    @else
                                        <option selected="" disabled>-- Chọn Quận/Huyện --</option>
                                    @endif
                                </select>
                                <input type="hidden" id="district_name" name="district_name"
                                    value="{{ old('district_name', $post->district) }}">
                                @error('district')
                                    <p style="color:red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="wards">Phường/Xã</label>
                                <select id="wards" class="form-control" name="ward">
                                    @if (!empty($post->ward))
                                        <option selected>{{ $post->ward }}</option>
                                    @else
                                        <option selected="" disabled>-- Chọn Phường/Xã --</option>
                                    @endif
                                </select>
                                <input type="hidden" id="ward_name" name="ward_name"
                                    value="{{ old('ward_name', $post->ward) }}">
                                @error('ward')
                                    <p style="color:red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <p>
                                <label for="country">Đường/Phố</label>
                                <input type="text" name="street" placeholder="Nhập tên đường/phố" id="country"
                                    value="{{ old('street', $post->street) }}">
                                @error('street')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <p class="no-mb first">
                                <label for="latitude">Số nhà</label>
                                <input type="text" name="house_number" placeholder="Nhập số nhà" id="latitude"
                                    value="{{ old('house_number', $post->house_number) }}">
                                @error('house_number')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <p class="no-mb last">
                                <label for="longitude">Địa chỉ</label>
                                <input type="text" name="address" placeholder="Địa chỉ" id="longitude"
                                    value="{{ old('address', $post->address) }}">
                                @error('address')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12 col-md-12">
                            <button id="find-location" class="btn btn-primary">Tìm vị trí trên bản đồ</button>
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

            <div class="single-add-property">
                <h3>thông tin liên hệ</h3>
                <div class="property-form-group">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <p>
                                <label for="con-name">Họ tên</label>
                                <input type="text" placeholder="Nhập họ tên" id="con-name" name="name_poster"
                                    value="{{ old('name_poster', $profileData->name) }}" readonly>
                                @error('name_poster')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <p class="no-mb first">
                                <label for="con-email">Email</label>
                                <input type="email" placeholder="Enter Your Email" id="con-email" name="email_poster"
                                    value="{{ $profileData->email }}" readonly>
                                @error('email_poster')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            </p>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <p class="no-mb last">
                                <label for="con-phn">Số điện thoại</label>
                                <input type="text" placeholder="Enter Your Phone Number" id="con-phn"
                                    name="phone_poster" value="{{ $profileData->phone }}" readonly>
                                @error('phone_poster')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
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

    {{-- Lấy API tỉnh thành --}}
    <script type="text/javascript">
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
                $("#district").html('<option value="">-- Chọn Quận / Huyện --</option>').niceSelect(
                    'update');
                $("#wards").html('<option value="">-- Chọn Phường / Xã --</option>').niceSelect('update');

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
                $("#wards").html('<option value="">-- Chọn Phường / Xã --</option>').niceSelect('update');

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

    {{-- Hiển thị video --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const videoInput = document.getElementById("videoLink");
            const videoContainer = document.getElementById("embeddedVideoContainer");
            const videoEmbed = document.getElementById("embeddedVideo");

            function getEmbeddedVideo(url) {
                let embedHtml = "";

                // Kiểm tra nếu là link YouTube
                if (url.includes("youtube.com/watch?v=") || url.includes("youtu.be/")) {
                    let videoId = url.split("v=")[1]?.split("&")[0] || url.split("youtu.be/")[1];
                    if (videoId) {
                        embedHtml =
                            `<iframe width="100%" height="600" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
                    }
                }
                // Kiểm tra nếu là link TikTok
                else if (url.includes("tiktok.com/")) {
                    const match = url.match(/video\/(\d+)/);
                    const videoId = match ? match[1] : null;
                    if (videoId) {
                        embedHtml = `
                        <blockquote class="tiktok-embed" cite="${url}" data-video-id="${videoId}" style="max-width: 100%;">
                            <section></section>
                        </blockquote>
                    `;
                    }
                }

                return embedHtml;
            }

            function updateVideoPreview() {
                const url = videoInput.value.trim();
                const embedHtml = getEmbeddedVideo(url);

                if (embedHtml) {
                    videoEmbed.innerHTML = embedHtml;
                    videoContainer.style.display = "block";

                    // Kiểm tra và nạp script TikTok nếu cần
                    if (url.includes("tiktok.com/")) {
                        if (!window.tiktokEmbedLoaded) {
                            var script = document.createElement("script");
                            script.src = "https://www.tiktok.com/embed.js";
                            script.async = true;
                            script.onload = () => {
                                window.tiktokEmbedLoaded = true;
                            };
                            document.body.appendChild(script);
                        } else if (window.tiktokEmbedLoad) {
                            window.tiktokEmbedLoad(); // Tải lại video TikTok nếu script đã có
                        }
                    }
                } else {
                    videoEmbed.innerHTML = "";
                    videoContainer.style.display = "none";
                }
            }

            // Khi trang tải, nếu đã có video_url thì hiển thị video
            updateVideoPreview();

            // Khi người dùng nhập URL mới, cập nhật video nhúng
            videoInput.addEventListener("input", updateVideoPreview);
        });
    </script>

    {{-- Hiển thị ảnh --}}
    <script type="text/javascript">
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

    {{-- Xoá ảnh --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", ".delete-image", function(e) {
                e.preventDefault();
                var imageId = $(this).data("id");

                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn muốn xóa ảnh này?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, xóa nó!",
                    cancelButtonText: "Huỷ"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('poster.delete.image') }}",
                            type: "POST",
                            data: {
                                id: imageId,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                if (data.success) {
                                    $("#image-" + imageId)
                                        .remove(); // Xóa ảnh khỏi giao diện
                                    Swal.fire("Đã xóa!", "Ảnh đã được xóa.", "success");
                                } else {
                                    Swal.fire("Lỗi!", "Không thể xóa ảnh.", "error");
                                }
                            },
                            error: function() {
                                Swal.fire("Lỗi!", "Đã xảy ra lỗi khi xóa ảnh.",
                                    "error");
                            }
                        });
                    }
                });
            });
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
                let simplifiedAddress = fullAddress.replace(/^.*?, /, '');

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
                    } else {
                        Swal.fire({
                            title: "Không tìm thấy vị trí!",
                            text: "Vui lòng kiểm tra lại địa chỉ.",
                            icon: "warning",
                        });
                    }
                });
            });

        });
    </script>
@endsection
