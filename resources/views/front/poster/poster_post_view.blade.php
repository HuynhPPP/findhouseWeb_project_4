@extends('front.poster.poster_dashboard')
@section('poster')

<style>
    .inner-pages .nice-select.open .list {
        max-height: 300px; 
        overflow-y: auto !important; 
        overflow: visible;
        z-index: 99999;
        width: 100%;
    }
</style>

<div class="col-lg-9 col-md-12 col-xs-12 royal-add-property-area section_100 pl-0 user-dash2">
    <div class="single-add-property">
        <h3>Thông tin mô tả</h3>
        <div class="property-form-group">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" id="title" placeholder="">
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <label for="description">Nội dung mô tả</label>
                            <textarea class="textarea" id="description" name="pro-dexc" placeholder=""></textarea>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 dropdown faq-drop">
                        <div class="form-group categories">
                            <div class="nice-select form-control wide" tabindex="0"><span class="current">Select
                                    status</span>
                                <ul class="list">
                                    <li data-value="1" class="option">Rent</li>
                                    <li data-value="2" class="option">Sale</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 dropdown faq-drop">
                        <div class="form-group categories">
                            <div class="nice-select form-control wide" tabindex="0"><span class="current">Type</span>
                                <ul class="list">
                                    <li data-value="1" class="option">house</li>
                                    <li data-value="2" class="option">commercial</li>
                                    <li data-value="3" class="option">apartment</li>
                                    <li data-value="4" class="option">lot</li>
                                    <li data-value="5" class="option">garage</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 dropdown faq-drop">
                        <div class="form-group categories">
                            <div class="nice-select form-control wide" tabindex="0"><span class="current">Rooms</span>
                                <ul class="list">
                                    <li data-value="1" class="option">1</li>
                                    <li data-value="2" class="option">2</li>
                                    <li data-value="3" class="option">3</li>
                                    <li data-value="4" class="option">4</li>
                                    <li data-value="5" class="option">5</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <p class="no-mb">
                            <label for="price">Giá cho thuê</label>
                            <input type="text" name="price" placeholder="VND" id="price">
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <p class="no-mb last">
                            <label for="area">Diện tích</label>
                            <input type="text" name="area" placeholder="m&sup2;" id="area">
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="single-add-property">
        <h3>Hình ảnh</h3>
        <div class="property-form-group">
            <div class="row">
                <div class="col-md-12">
                    <form action="https://code-theme.com/file-upload" class="dropzone"></form>
                </div>
            </div>
        </div>
    </div>
    <div class="single-add-property">
        <h3>Video</h3>
        <div class="property-form-group">
            <div class="row">
                <div class="col-md-12">
                    <form action="https://code-theme.com/file-upload" class="dropzone"></form>
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
                        <select id="province" class="form-control">
                            <option value="">Chọn Tỉnh/Thành phố</option>
                        </select>
                        <input type="hidden" id="province_name" name="province_name">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="form-group">
                        <label for="district">Quận/Huyện</label>
                        <select id="district" class="form-control">
                            <option value="">Chọn Quận/Huyện</option>
                        </select>
                        <input type="hidden" id="district_name" name="district_name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="wards">Phường/Xã</label>
                        <select id="wards" class="form-control">
                            <option value="">Chọn Phường/Xã</option>
                        </select>
                        <input type="hidden" id="ward_name" name="ward_name">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <p>
                        <label for="country">Đường/Phố</label>
                        <input type="text" name="country" placeholder="Enter Your Country" id="country">
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p class="no-mb first">
                        <label for="latitude">Số nhà</label>
                        <input type="text" name="latitude" placeholder="Nhập số nhà" id="latitude">
                    </p>
                </div>
                <div class="col-lg-6 col-md-12">
                    <p class="no-mb last">
                        <label for="longitude">Địa chỉ</label>
                        <input type="text" name="longitude" placeholder="Địa chỉ" id="longitude">
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="single-add-property">
        <h3>Bản đồ</h3>
        <div id="map-contact" class="contact-map leaflet-container leaflet-fade-anim" tabindex="0"
            data-gesture-handling-touch-content="Use two fingers to move the map"
            data-gesture-handling-scroll-content="Use ctrl + scroll to zoom the map" style="position: relative;">
            <div class="leaflet-map-pane" style="transform: translate3d(-1005px, 342px, 0px);">
                <div class="leaflet-tile-pane">
                    <div class="leaflet-layer">
                        <div class="leaflet-tile-container leaflet-zoom-animated" style=""></div>
                        <div class="leaflet-tile-container leaflet-zoom-animated" style=""><img
                                class="leaflet-tile leaflet-tile-loaded"
                                src="https://a.tile.openstreetmap.de/tiles/osmde/1/0/0.png"
                                style="height: 256px; width: 256px; left: 975px; top: -433px;"><img
                                class="leaflet-tile leaflet-tile-loaded"
                                src="https://b.tile.openstreetmap.de/tiles/osmde/1/0/1.png"
                                style="height: 256px; width: 256px; left: 975px; top: -177px;"><img
                                class="leaflet-tile leaflet-tile-loaded"
                                src="https://b.tile.openstreetmap.de/tiles/osmde/1/1/0.png"
                                style="height: 256px; width: 256px; left: 719px; top: -433px;"><img
                                class="leaflet-tile leaflet-tile-loaded"
                                src="https://b.tile.openstreetmap.de/tiles/osmde/1/1/0.png"
                                style="height: 256px; width: 256px; left: 1231px; top: -433px;"><img
                                class="leaflet-tile leaflet-tile-loaded"
                                src="https://c.tile.openstreetmap.de/tiles/osmde/1/1/1.png"
                                style="height: 256px; width: 256px; left: 719px; top: -177px;"><img
                                class="leaflet-tile leaflet-tile-loaded"
                                src="https://c.tile.openstreetmap.de/tiles/osmde/1/1/1.png"
                                style="height: 256px; width: 256px; left: 1231px; top: -177px;"><img
                                class="leaflet-tile leaflet-tile-loaded"
                                src="https://a.tile.openstreetmap.de/tiles/osmde/1/0/0.png"
                                style="height: 256px; width: 256px; left: 1487px; top: -433px;"><img
                                class="leaflet-tile leaflet-tile-loaded"
                                src="https://b.tile.openstreetmap.de/tiles/osmde/1/0/1.png"
                                style="height: 256px; width: 256px; left: 1487px; top: -177px;"><img
                                class="leaflet-tile leaflet-tile-loaded"
                                src="https://b.tile.openstreetmap.de/tiles/osmde/1/1/0.png"
                                style="height: 256px; width: 256px; left: 1743px; top: -433px;"><img
                                class="leaflet-tile leaflet-tile-loaded"
                                src="https://c.tile.openstreetmap.de/tiles/osmde/1/1/1.png"
                                style="height: 256px; width: 256px; left: 1743px; top: -177px;"></div>
                    </div>
                </div>
                <div class="leaflet-objects-pane">
                    <div class="leaflet-shadow-pane"></div>
                    <div class="leaflet-overlay-pane"></div>
                    <div class="leaflet-marker-pane">
                        <div class="leaflet-marker-icon leaflet-div-icon leaflet-zoom-animated leaflet-clickable"
                            tabindex="0"
                            style="margin-left: -50px; margin-top: -50px; width: 50px; height: 50px; transform: translate3d(1125px, -241px, 0px); z-index: -241;">
                            <i class="fa fa-building"></i></div>
                    </div>
                    <div class="leaflet-popup-pane"></div>
                </div>
            </div>
            <div class="leaflet-control-container">
                <div class="leaflet-top leaflet-left">
                    <div class="leaflet-control-zoom leaflet-bar leaflet-control"><a class="leaflet-control-zoom-in"
                            href="#" title="Zoom in">+</a><a class="leaflet-control-zoom-out" href="#"
                            title="Zoom out">-</a></div>
                </div>
                <div class="leaflet-top leaflet-right"></div>
                <div class="leaflet-bottom leaflet-left"></div>
                <div class="leaflet-bottom leaflet-right">
                    <div class="leaflet-control-attribution leaflet-control"><a href="http://leafletjs.com"
                            title="A JS library for interactive maps">Leaflet</a> | © <a
                            href="http://osm.org/copyright">OpenStreetMap</a> contributors</div>
                </div>
            </div>
        </div>
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
                                    <input id="check-a" type="checkbox" name="check">
                                    <label for="check-a">Air Conditioning</label>
                                </div>
                            </div>
                        </li>
                        <li class="fl-wrap filter-tags clearfix">
                            <div class="checkboxes float-left">
                                <div class="filter-tags-wrap">
                                    <input id="check-b" type="checkbox" name="check">
                                    <label for="check-b">Swimming Pool</label>
                                </div>
                            </div>
                        </li>
                        <li class="fl-wrap filter-tags clearfix">
                            <div class="checkboxes float-left">
                                <div class="filter-tags-wrap">
                                    <input id="check-c" type="checkbox" name="check">
                                    <label for="check-c">Central Heating</label>
                                </div>
                            </div>
                        </li>
                        <li class="fl-wrap filter-tags clearfix">
                            <div class="checkboxes float-left">
                                <div class="filter-tags-wrap">
                                    <input id="check-d" type="checkbox" name="check">
                                    <label for="check-d">Laundry Room</label>
                                </div>
                            </div>
                        </li>
                        <li class="fl-wrap filter-tags clearfix">
                            <div class="checkboxes float-left">
                                <div class="filter-tags-wrap">
                                    <input id="check-e" type="checkbox" name="check">
                                    <label for="check-e">Gym</label>
                                </div>
                            </div>
                        </li>
                        <li class="fl-wrap filter-tags clearfix">
                            <div class="checkboxes float-left">
                                <div class="filter-tags-wrap">
                                    <input id="check-g" type="checkbox" name="check">
                                    <label for="check-g">Alarm</label>
                                </div>
                            </div>
                        </li>
                        <li class="fl-wrap filter-tags clearfix">
                            <div class="checkboxes float-left">
                                <div class="filter-tags-wrap">
                                    <input id="check-h" type="checkbox" name="check">
                                    <label for="check-h">Window Covering</label>
                                </div>
                            </div>
                        </li>
                        <li class="fl-wrap filter-tags clearfix">
                            <div class="checkboxes float-left">
                                <div class="filter-tags-wrap">
                                    <input id="check-i" type="checkbox" name="check">
                                    <label for="check-i">Refrigerator</label>
                                </div>
                            </div>
                        </li>
                        <li class="fl-wrap filter-tags clearfix">
                            <div class="checkboxes float-left">
                                <div class="filter-tags-wrap">
                                    <input id="check-j" type="checkbox" name="check">
                                    <label for="check-j">TV Cable & WIFI</label>
                                </div>
                            </div>
                        </li>
                        <li class="fl-wrap filter-tags clearfix">
                            <div class="checkboxes float-left">
                                <div class="filter-tags-wrap">
                                    <input id="check-k" type="checkbox" name="check">
                                    <label for="check-k">Microwave</label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="single-add-property">
        <h3>thông tin liên hệ</h3>
        <div class="property-form-group">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <p>
                        <label for="con-name">Họ tên</label>
                        <input type="text" placeholder="Enter Your Name" id="con-name" name="con-name">
                    </p>
                </div>
            
                <div class="col-lg-4 col-md-12">
                    <p class="no-mb first">
                        <label for="con-email">Email</label>
                        <input type="email" placeholder="Enter Your Email" id="con-email" name="con-email">
                    </p>
                </div>
                <div class="col-lg-4 col-md-12">
                    <p class="no-mb last">
                        <label for="con-phn">Số điện thoại</label>
                        <input type="text" placeholder="Enter Your Phone Number" id="con-phn" name="con-phn">
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
@endsection


@section('customJs')
<script>
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


</script>

<script>
    // Cấu hình Dropzone
    Dropzone.options.myDropzone = {
        // Xử lý khi ảnh được tải lên thành công
        success: function(file, response) {
            // Ẩn thông báo lỗi "Server responded with 0 code"
            $(".dz-error-message").hide();

            // Tạo nút xóa cho từng file tải lên
            const removeButton = Dropzone.createElement("<button class='dz-remove'>Xóa</button>");
            removeButton.addEventListener("click", function() {
                file.previewElement.remove();  // Xóa ảnh khỏi Dropzone
            });
            file.previewElement.appendChild(removeButton);  // Thêm nút xóa vào preview của ảnh
        },
        
        // Xử lý khi có lỗi khi tải lên
        error: function(file, response) {
            // Ẩn thông báo lỗi mặc định
            $(".dz-error-message").hide();
        },
        
        // Xử lý khi hình ảnh được xóa
        removedfile: function(file) {
            // Đảm bảo ảnh được xóa khỏi form
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        
        // Cấu hình thêm vào nếu bạn muốn
        maxFiles: 5,  // Giới hạn số lượng file tải lên
        maxFilesize: 5,  // Giới hạn kích thước mỗi file tải lên (MB)
        acceptedFiles: "image/*"  // Chỉ cho phép tải lên hình ảnh
    };
</script>
@endsection

