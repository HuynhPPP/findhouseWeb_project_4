@extends('admin.master')
@section('customCss')
  <link href="{{ asset('admin/trumbowyg/trumbowyg.min.css') }}" rel="stylesheet"
    type="text/css" id="app-style" />
  <link rel="stylesheet" href="{{ asset('admin/css/post_video.css') }}">
@endsection
@section('title')
  {{ $post->title }}
@endsection
@section('content')
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
      <div class="card">
        <div class="card-header">
          <h5>Cập nhật</h5>
        </div>
        <div class="card-block">
          <form method="POST" enctype="multipart/form-data"
            action="{{ route('admin.store.update.post', ['post_id' => $post->id]) }}"
            class="mb-3 row">
            @csrf
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label col-form-label">Tiêu đề</label>
                <input type="text"
                  class="form-control fill @error('title') is-invalid @enderror"
                  id="title" name="title"
                  value="{{ old('title', $post->title) }}">
                @error('title')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
              <div class="row">
                <div class="mb-3 col">
                  <label class="form-label col-form-label">Giá</label>
                  <div class="">
                    <input type="text"
                      class="form-control fill @error('title') is-invalid @enderror"
                      id="price" name="price"
                      value="{{ old('price', $post->price) }}">
                    @error('price')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="mb-3 col">
                  <label class="form-label col-form-label">Diện tích</label>
                  <div class="">
                    <input type="text"
                      class="form-control fill @error('area') is-invalid @enderror"
                      id="area" name="area"
                      value="{{ old('area', $post->area) }}">
                    @error('area')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Danh mục</label>
                <select class="border form-select form-control fill"
                  name="category_id">
                  <option disabled selected>Chọn danh mục</option>
                  @foreach ($categories as $cat)
                    <option
                      {{ $post->category_id == $cat->id ? 'selected' : '' }}
                      value="{{ $cat->id }}">{{ $cat->category_name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3 ">
                <div class="mb-3 has-success">
                  <label class="form-label col-sm-2">Trạng thái</label>
                  <div class="col">
                    <div class="form-radio">
                      <div class="radio radiofill radio-primary radio-inline">
                        <label class="form-label">
                          <input
                            {{ $post->status == 'approved' ? 'checked' : '' }}
                            type="radio" name="status" value="approved">
                          <i class="helper"></i>Đã duyệt
                        </label>
                      </div>
                      <div class="radio radiofill radio-primary radio-inline">
                        <label class="form-label">
                          <input
                            {{ $post->status == 'pending' ? 'checked' : '' }}
                            type="radio" name="status" value="pending">
                          <i class="helper"></i>Chờ duyệt
                        </label>
                      </div>
                      <div class="radio radiofill radio-primary radio-inline">
                        <label class="form-label">
                          <input
                            {{ $post->status == 'rejected' ? 'checked' : '' }}
                            type="radio" name="status" value="rejected">
                          <i class="helper"></i>Hủy bỏ
                        </label>
                      </div>
                      <div class="radio radiofill radio-primary radio-inline">
                        <label class="form-label">
                          <input {{ $post->status == 'hidden' ? 'checked' : '' }}
                            type="radio" name="status" value="hidden">
                          <i class="helper"></i>Ẩn
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-3">
                  <div class="mb-3">
                    <div class="checkbox-fade fade-in-primary">
                      <label class="form-label">
                        <input {{ $post->is_featured == 1 ? 'checked' : '' }}
                          name="is_featured" type="checkbox" value="1">
                        <span class="cr">
                          <i
                            class="cr-icon icofont icofont-ui-check txt-primary"></i>
                        </span>
                        <span>Đặc trưng</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-3">
                  <div class="mb-3">
                    <div class="checkbox-fade fade-in-primary">
                      <label class="form-label">
                        <input {{ $post->is_favorite == 1 ? 'checked' : '' }}
                          name="is_favorite" type="checkbox" value="1">
                        <span class="cr">
                          <i
                            class="cr-icon icofont icofont-ui-check txt-primary"></i>
                        </span>
                        <span>Yêu thích</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mb-3 col">
                <label class="form-label col-form-label">Link video</label>
                <input type="text"
                  class="form-control fill @error('video_url') is-invalid @enderror"
                  name="video_url"
                  value="{{ old('video_url', $post->video_url) }}">
                @error('video_url')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="video-upload-container">
                  <!-- Hiển thị video đã có -->
                  <div id="existingVideos">
                    <div class="video-item" id="video-{{ $post->id }}">
                      <div class="video-container">
                        <iframe id="videoPreviewFrame" width="560"
                          height="315" src="{{ $post->video_url }}"
                          title="YouTube video player" frameborder="0"
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                          allowfullscreen>
                        </iframe>
                      </div>
                    </div>
                  </div>
                  <!-- Khu vực xem trước video mới -->
                  <video id="videoPreview" controls
                    style="display: none;"></video>
                  <button type="button" id="removeVideo" class="remove-btn"
                    style="display: none;">&times;</button>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label col-form-label">Tỉnh/ Thành
                  phố</label>
                <select class="border form-select form-control fill"
                  name="province" id="province">
                  @if (!empty($post->province))
                    <option selected>{{ $post->province }}</option>
                  @else
                    <option selected="" disabled>-- Chọn Tỉnh/Thành phố --
                    </option>
                  @endif
                </select>
                <input type="hidden" id="province_name" name="province_name"
                  value="{{ old('province_name', $post->province) }}">
                <p></p>
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Quận/Huyện</label>
                <select class="border form-select form-control fill"
                  name="district" id="district">
                  @if (!empty($post->district))
                    <option selected>{{ $post->district }}</option>
                  @else
                    <option selected="" disabled>-- Chọn Quận/Huyện --
                    </option>
                  @endif
                </select>
                <input type="hidden" id="district_name" name="district_name"
                  value="{{ old('district_name', $post->district) }}">
                <p></p>
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Phường/Xã</label>
                <select class="border form-select form-control fill"
                  name="ward" id="ward">
                  @if (!empty($post->ward))
                    <option selected>{{ $post->ward }}</option>
                  @else
                    <option selected="" disabled>-- Chọn Phường/Xã --</option>
                  @endif
                </select>
                <input type="hidden" id="ward_name" name="ward_name"
                  value="{{ old('ward_name', $post->ward) }}">
                <p></p>
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Tên đường</label>
                <input type="text"
                  class="form-control fill @error('street') is-invalid @enderror"
                  id="street" name="street"
                  value="{{ old('street', $post->street) }}">
                @error('street')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Số nhà</label>
                <input type="text"
                  class="form-control fill @error('house_number') is-invalid @enderror"
                  id="house_number" name="house_number"
                  value="{{ old('house_number', $post->house_number) }}">
                @error('house_number')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label class="form-label col-form-label">Mô tả</label>
                <textarea name="description"
                  class="form-control max-textarea description @error('description')
                    is-invalid @enderror"
                  maxlength="255" rows="4" style="height: 102px;">{{ old('description', $post->description) }}</textarea>
                @error('description')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="col">
              <button type="submit" class="btn btn-primary">Cập nhật</button>
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
              let selected = (val_tinh.id == oldProvince) ? "selected" :
                "";
              $("#province").append('<option value="' + val_tinh.id +
                '" ' + selected + '>' + val_tinh.full_name +
                '</option>');
            });
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
          $("#district").html(
            '<option value="">-- Chọn Quận / Huyện --</option>');
          $("#ward").html(
            '<option value="">-- Chọn Phường / Xã --</option>');
          if (provinceId) {
            loadDistricts(provinceId, null, null);
          }
        });
        // Load danh sách quận/huyện
        function loadDistricts(provinceId, selectedDistrict, selectedWard) {
          $.getJSON('/api/proxy/districts/' + provinceId, function(data_quan) {
            if (data_quan.error === 0) {
              $.each(data_quan.data, function(key_quan, val_quan) {
                let selected = (val_quan.id == selectedDistrict) ?
                  "selected" : "";
                $("#district").append('<option value="' + val_quan.id +
                  '" ' + selected + '>' + val_quan.full_name +
                  '</option>');
              });
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
          $("#ward").html(
            '<option value="">-- Chọn Phường / Xã --</option>');
          if (districtId) {
            loadWards(districtId, null);
          }
        });
        // Load danh sách phường/xã
        function loadWards(districtId, selectedWard) {
          $.getJSON('/api/proxy/wards/' + districtId, function(data_phuong) {
            if (data_phuong.error === 0) {
              $.each(data_phuong.data, function(key_phuong, val_phuong) {
                let selected = (val_phuong.id == selectedWard) ?
                  "selected" : "";
                $("#ward").append('<option value="' + val_phuong.id +
                  '" ' + selected + '>' + val_phuong.full_name +
                  '</option>');
              });

              if (selectedWard) {
                $("#ward_name").val("{{ old('ward_name') }}");
              }
            }
          });
        }
        // Khi chọn xã
        $("#ward").change(function() {
          let wardName = $("#ward option:selected").text();
          $("#ward_name").val(wardName);
        });
      });
    </script>
    <script src="{{ asset('admin/trumbowyg/trumbowyg.min.js') }}"></script>
    <script>
      $('.description').trumbowyg({
        btns: [
          ['viewHTML'],
          ['undo', 'redo'],
          ['formatting'],
          ['strong', 'em', 'del'],
          ['superscript', 'subscript'],
          ['link'],
          ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
          ['unorderedList', 'orderedList'],
          ['horizontalRule'],
          ['removeformat'],
          ['fullscreen']
        ]
      });
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const videoInput = document.querySelector("input[name='video_url']");
        const videoPreview = document.getElementById("videoPreviewFrame");
        const existingVideos = document.getElementById(
          "existingVideos"); // Lấy đúng ID
        function convertToEmbedUrl(url) {
          const regex =
            /(?:youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/|.+\?v=)|youtu\.be\/)([^&?]+)/;
          const match = url.match(regex);
          return match ? `https://www.youtube.com/embed/${match[1]}` : null;
        }

        function updateVideoDisplay() {
          const url = videoInput.value.trim();
          const embedUrl = convertToEmbedUrl(url);

          if (embedUrl) {
            videoPreview.src = embedUrl;
            if (existingVideos) existingVideos.style.display =
              "block"; // Hiện existingVideos nếu có video
          } else {
            videoPreview.src = "";
            if (existingVideos) existingVideos.style.display =
              "none"; // Ẩn existingVideos nếu không có video
          }
        }
        // Lắng nghe sự kiện khi nhập dữ liệu vào input
        videoInput.addEventListener("input", updateVideoDisplay);
        // Kiểm tra trạng thái ban đầu khi trang load
        updateVideoDisplay();
      });
    </script>
  @endsection
@endsection
