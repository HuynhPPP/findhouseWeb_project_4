@extends('front.poster.poster_dashboard')
@section('poster')

<link rel="stylesheet" href="{{ asset('front/css/poster_post_view.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />


<style>
    .custom-select-box {
        position: relative;
        width: 100%;
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

    <form action="{{ route('poster.post.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="single-add-property">
            <h3>Thông tin mô tả</h3>
            <div class="property-form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label for="title">Tiêu đề</label>
                                <input type="text" name="title" id="title" placeholder="" value="{{ old('title') }}">
                                @error('title') <p style="color:red">{{ $message }}</p> @enderror
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
                                @error('description') <p style="color:red">{{ $message }}</p> @enderror
                            </p>
                        </div>
                    </div>
                    @php
                        $categories = App\Models\Category::get();
                    @endphp
                    <div class="row">
                        <div class="col-lg-6 col-md-12 dropdown faq-drop">
                            <div class="form-group mb-3">
                                <label for="province">Loại chuyên mục</label>
                                <select class="form-control" name="category_id">
                                    <option selected="" disabled>-- Chọn loại chuyên mục --</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->category_name }}
                                        </option>
                                    @endforeach 
                                </select>
                                @error('category_id') <p style="color:red">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <p class="no-mb">
                                <label for="price">Giá cho thuê</label>
                                <input type="text" name="price" placeholder="VND" id="price" value="{{ old('price') }}">
                                @error('price') <p style="color:red">{{ $message }}</p> @enderror
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <p class="no-mb last">
                                <label for="area">Diện tích</label>
                                <input type="text" name="area" placeholder="m&sup2;" id="area" value="{{ old('area') }}">
                                @error('area') <p style="color:red">{{ $message }}</p> @enderror
                            </p>
                        </div>
                    </div>
            </div>
        </div>

        <div class="single-add-property">
            <h3>Hình ảnh</h3>
            <div class="property-form-group">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Khu vực kéo thả hoặc nhấn để tải ảnh -->
                        <div class="drop-zone" id="dropZone">
                            <p> Kéo thả ảnh vào đây hoặc <b>Nhấn để chọn ảnh</b></p>
                            <input type="file" id="image" name="photos[]" multiple style="display: none;" />
                        </div>

                        <!-- Hiển thị ảnh xem trước -->
                        <div class="image-preview" id="imagePreview"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-add-property">
            <h3>Video</h3>
            <div class="property-form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="video-upload-container">
                            <input type="file" id="videoUpload" name="video" accept="video/*" hidden>
                            
                            <label for="videoUpload" class="upload-box">
                                <i class="fa fa-video-camera" aria-hidden="true"></i>
                                <span>Tải Video từ thiết bị</span>
                            </label>
                        
                            <video id="videoPreview" controls style="display: none;"></video>
                        
                            <button id="removeVideo" class="remove-btn" style="display: none;">Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                            <input type="hidden" id="province_name" name="province_name" value="{{ old('province_name') }}">
                            @error('province') <p style="color:red">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="form-group">
                            <label for="district">Quận/Huyện</label>
                            <select id="district" class="form-control" name="district">
                                <option selected="" disabled>-- Chọn Quận/Huyện --</option>
                            </select>
                            <input type="hidden" id="district_name" name="district_name" value="{{ old('district_name') }}">
                            @error('district') <p style="color:red">{{ $message }}</p> @enderror
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
                            @error('ward') <p style="color:red">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <p>
                            <label for="country">Đường/Phố</label>
                            <input type="text" name="street" placeholder="Nhập tên đường/phố" id="country" value="{{ old('street') }}">
                            @error('street') <p style="color:red">{{ $message }}</p> @enderror
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <p class="no-mb first">
                            <label for="latitude">Số nhà</label>
                            <input type="text" name="house_number" placeholder="Nhập số nhà" id="latitude" value="{{ old('house_number') }}">
                            @error('house_number') <p style="color:red">{{ $message }}</p> @enderror
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <p class="no-mb last">
                            <label for="longitude">Địa chỉ</label>
                            <input type="text" name="address" placeholder="Địa chỉ" id="longitude" value="{{ old('address') }}">
                            @error('address') <p style="color:red">{{ $message }}</p> @enderror
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-add-property">
            <h3>Bản đồ</h3>
            <div id="map"></div>
        </div>

        <div class="single-add-property">
            <h3>Đặc điểm nổi bật</h3>
            <div class="property-form-group">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="pro-feature-add pl-0">
                            <li class="fl-wrap filter-tags clearfix">
                                <div class="checkboxes float-left">
                                    <div class="filter-tags-wrap">
                                        <input id="check-a" type="checkbox" name="features[]" value="Đầy đủ nội thất">
                                        <label for="check-a">Đầy đủ nội thất</label>
                                    </div>
                                </div>
                            </li>
                            <li class="fl-wrap filter-tags clearfix">
                                <div class="checkboxes float-left">
                                    <div class="filter-tags-wrap">
                                        <input id="check-b" type="checkbox" name="features[]" value="Có máy lạnh">
                                        <label for="check-b">Có máy lạnh</label>
                                    </div>
                                </div>
                            </li>
                            <li class="fl-wrap filter-tags clearfix">
                                <div class="checkboxes float-left">
                                    <div class="filter-tags-wrap">
                                        <input id="check-c" type="checkbox" name="features[]" value="Có thang máy">
                                        <label for="check-c">Có thang máy</label>
                                    </div>
                                </div>
                            </li>
                            <li class="fl-wrap filter-tags clearfix">
                                <div class="checkboxes float-left">
                                    <div class="filter-tags-wrap">
                                        <input id="check-d" type="checkbox" name="features[]" value="Có kệ bếp">
                                        <label for="check-d">Có kệ bếp</label>
                                    </div>
                                </div>
                            </li>
                            <li class="fl-wrap filter-tags clearfix">
                                <div class="checkboxes float-left">
                                    <div class="filter-tags-wrap">
                                        <input id="check-e" type="checkbox" name="features[]" value="Có hầm để xe">
                                        <label for="check-e">Có hầm để xe</label>
                                    </div>
                                </div>
                            </li>
                            <li class="fl-wrap filter-tags clearfix">
                                <div class="checkboxes float-left">
                                    <div class="filter-tags-wrap">
                                        <input id="check-g" type="checkbox" name="features[]" value="Có gác">
                                        <label for="check-g">Có gác</label>
                                    </div>
                                </div>
                            </li>
                            <li class="fl-wrap filter-tags clearfix">
                                <div class="checkboxes float-left">
                                    <div class="filter-tags-wrap">
                                        <input id="check-h" type="checkbox" name="features[]" value="Có bảo vệ 24/24">
                                        <label for="check-h">Có bảo vệ 24/24</label>
                                    </div>
                                </div>
                            </li>
                            <li class="fl-wrap filter-tags clearfix">
                                <div class="checkboxes float-left">
                                    <div class="filter-tags-wrap">
                                        <input id="check-i" type="checkbox" name="features[]" value="Có hồ bơi">
                                        <label for="check-i">Có hồ bơi</label>
                                    </div>
                                </div>
                            </li>
                            <li class="fl-wrap filter-tags clearfix">
                                <div class="checkboxes float-left">
                                    <div class="filter-tags-wrap">
                                        <input id="check-j" type="checkbox" name="features[]" value="Giờ giấc tự do">
                                        <label for="check-j">Giờ giấc tự do</label>
                                    </div>
                                </div>
                            </li>
                            <li class="fl-wrap filter-tags clearfix">
                                <div class="checkboxes float-left">
                                    <div class="filter-tags-wrap">
                                        <input id="check-k" type="checkbox" name="features[]" value="Không chung chủ">
                                        <label for="check-k">Không chung chủ</label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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
                            <input type="text" 
                                placeholder="Nhập họ tên" 
                                id="con-name" 
                                name="name_poster"
                                value="{{ old('name_poster', $profileData->name) }}"
                            >
                            @error('name_poster') <p style="color:red">{{ $message }}</p> @enderror
                        </p>
                    </div>
                
                    <div class="col-lg-4 col-md-12">
                        <p class="no-mb first">
                            <label for="con-email">Email</label>
                            <input type="email" 
                                placeholder="Enter Your Email" 
                                id="con-email" 
                                name="email_poster"
                                value="{{ $profileData->email }}"
                            >
                            @error('email_poster') <p style="color:red">{{ $message }}</p> @enderror
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <p class="no-mb last">
                            <label for="con-phn">Số điện thoại</label>
                            <input type="text" 
                                placeholder="Enter Your Phone Number" 
                                id="con-phn" 
                                name="phone_poster"
                                value="{{ $profileData->phone }}"
                            >
                            @error('phone_poster') <p style="color:red">{{ $message }}</p> @enderror
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
<script src="{{ asset('front/js/map_post_view.js') }}"></script>

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
                    $("#province").append('<option value="' + val_tinh.id + '" ' + selected + '>' + val_tinh.full_name + '</option>');
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
            $("#district").html('<option value="">-- Chọn Quận / Huyện --</option>').niceSelect('update');
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
                        $("#district").append('<option value="' + val_quan.id + '" ' + selected + '>' + val_quan.full_name + '</option>');
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
                        $("#wards").append('<option value="' + val_phuong.id + '" ' + selected + '>' + val_phuong.full_name + '</option>');
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



{{-- <script>
    $(document).ready(function() {
    // Lấy danh sách tỉnh
    $.getJSON('/api/proxy/provinces', function(data_tinh) {
        if (data_tinh.error === 0) {
        $.each(data_tinh.data, function(key_tinh, val_tinh) {
            $("#province").append('<option value="' + val_tinh.id + '">' + val_tinh.full_name + '</option>');
    });

      // Khởi tạo nice-select sau khi thêm option
      $("#province").niceSelect('update');

      // Khi chọn tỉnh
      $("#province").change(function() {
        var idtinh = $(this).val();
        var tentinh = $("#province option:selected").text();
        $("#province_name").val(tentinh); // Lưu tên tỉnh

        // Kiểm tra xem tỉnh đã được chọn hay chưa
        if (idtinh != "") {
          $.getJSON('/api/proxy/districts/' + idtinh, function(data_quan) {
            if (data_quan.error === 0) {
              // Reset lại các thẻ huyện và xã trước khi thêm mới
              $("#district").html('<option value="0">Chọn Quận / Huyện</option>');
              $("#wards").html('<option value="0">Chọn Phường / Xã</option>');

              // Thêm các huyện vào dropdown
              $.each(data_quan.data, function(key_quan, val_quan) {
                $("#district").append('<option value="' + val_quan.id + '">' + val_quan.full_name + '</option>');
              });

              // Khởi tạo lại nice-select sau khi thêm các huyện vào
              $("#district").niceSelect('update');

              // Khi chọn quận
              $("#district").change(function() {
                var idquan = $(this).val();
                var tenquan = $("#district option:selected").text();
                $("#district_name").val(tenquan); // Lưu tên huyện

                // Lấy danh sách xã/phường
                $.getJSON('/api/proxy/wards/' + idquan, function(data_phuong) {
                  if (data_phuong.error === 0) {
                    $("#wards").html('<option value="0">Chọn Phường / Xã</option>'); // Reset lại xã/phường

                    // Thêm xã vào dropdown
                    $.each(data_phuong.data, function(key_phuong, val_phuong) {
                      $("#wards").append('<option value="' + val_phuong.id + '">' + val_phuong.full_name + '</option>');
                    });

                    // Khởi tạo lại nice-select sau khi thêm xã/phường
                    $("#wards").niceSelect('update');

                    // Khi chọn xã
                    $("#wards").change(function() {
                      var tenxa = $("#wards option:selected").text();
                      $("#ward_name").val(tenxa); // Lưu tên xã
                    });
                  }
                });
              });
            } else {
              alert("Không thể lấy dữ liệu quận/huyện!");
            }
          });
        }
      });
    }
  });
});


</script> --}}

<script type="text/javascript">
    document.getElementById('videoUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const videoPreview = document.getElementById('videoPreview');
            const removeButton = document.getElementById('removeVideo');
            
            videoPreview.src = URL.createObjectURL(file);
            videoPreview.style.display = "block";
            removeButton.style.display = "inline-block";
        }
    });

    // Xóa video
    document.getElementById('removeVideo').addEventListener('click', function() {
        const videoPreview = document.getElementById('videoPreview');

        // Dừng phát video
        videoPreview.pause();
        videoPreview.currentTime = 0;
        
        // Xóa src để giải phóng bộ nhớ
        videoPreview.src = "";

        // Ẩn video và nút xóa
        videoPreview.style.display = "none";
        this.style.display = "none";

        // Reset input file
        document.getElementById('videoUpload').value = "";
    });
</script>

<script>
    $(document).ready(function () {
        let dropZone = $("#dropZone");
        let inputFile = $("#image");
        let previewContainer = $("#imagePreview");

        // Khi click vào khu vực kéo thả thì mở hộp thoại chọn ảnh
        let isTriggering = false;

        dropZone.on("click", function (e) {
            if (!isTriggering) {
                isTriggering = true;
                inputFile.trigger("click");
                
                // Đặt lại trạng thái sau khi chọn file
                setTimeout(() => isTriggering = false, 500);
            }
        });

        // Khi chọn ảnh từ input file
        inputFile.on("change", function (e) {
            let files = e.target.files;
            previewImages(files);
        });

        // Kéo thả ảnh vào khu vực
        dropZone.on("dragover", function (e) {
            e.preventDefault();
            dropZone.addClass("dragover");
        });

        dropZone.on("dragleave", function () {
            dropZone.removeClass("dragover");
        });

        dropZone.on("drop", function (e) {
            e.preventDefault();
            dropZone.removeClass("dragover");

            let files = e.originalEvent.dataTransfer.files;
            previewImages(files);
        });

        // Hiển thị ảnh xem trước và thêm nút xóa ảnh
        function previewImages(files) {
            $.each(files, function (index, file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let imgContainer = $("<div>").css({
                        position: "relative",
                        display: "inline-block",
                    });

                    let img = $("<img>").attr("src", e.target.result).addClass("preview-img");

                    let removeBtn = $("<button>")
                        .addClass("remove-img")
                        .html("&times;") // Dấu x
                        .click(function () {
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

@endsection

