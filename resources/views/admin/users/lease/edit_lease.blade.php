@extends('admin.master')
@section('customCss')
  <!-- Data Table Css -->
  <link rel="stylesheet" type="text/css"
    href="{{ asset('admin/components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css"
    href="{{ asset('admin/pages/data-table/css/buttons.dataTables.min.css') }}">
@endsection
@section('title')
  {{ $lease->name }}
@endsection
@section('content')
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
      <!-- DOM/Jquery table start -->
      <div class="card-block">
        <div class="card">
          <div class="mb-3 card-header">
            <h5>Cập tài khoản</h5>
          </div>
          <form id="updateProfile" class="row"
            action="{{ route('admin.store.lease', ['id' => $lease->id]) }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            <div class="col-lg-12 col-xl-4">
              <div class="mb-4 card mb-xl-0">
                <div class="mb-3 text-center">
                  <div class="col">
                    <img id="avatar" width="150px" height="150px"
                      class="mb-2 img-account-profile rounded-circle"
                      src="{{ $lease->photo ? asset('upload/user_images/' . $lease->photo) : asset('admin/images/no_image.jpg') }}"
                      alt="avatar">
                  </div>
                  <div class="col">
                    <input type="file" name="photo" id="photo"
                      class="d-none ">
                  </div>
                  <label for="photo" class="btn btn-primary"
                    type="button">Thay
                    đổi hình ảnh</label>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-xl-8">
              <div class="card">
                <div class="card-header">
                  <h5>Tài khoản</h5>
                </div>
                <div class="card-block">
                  <div class="mb-3">
                    <label class="form-label col-form-label">Tên người
                      dùng</label>
                    <input type="text"
                      class="form-control fill @error('name')
                        is-invalid
                    @enderror"
                      id="name" name="name"
                      value="{{ old('name', $lease->name) }}">
                    @error('name')
                      <p class="invalid-feedback">{{ $message }}
                      </p>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label class="form-label col-form-label">Email</label>
                    <div class="">
                      <input type="text"
                        class="form-control fill @error('email')
                          is-invalid
                      @enderror"
                        id="email" name="email"
                        value="{{ old('email', $lease->email) }}">
                      @error('email')
                        <p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label col-form-label">Số điện
                      thoại</label>
                    <div class="">
                      <input type="text"
                        class="form-control fill @error('phone')
                          is-invalid
                      @enderror"
                        id="phone" name="phone"
                        value="{{ old('phone', $lease->phone) }}">
                      @error('phone')
                        <p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Cập
                    nhật</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- DOM/Jquery table end -->
    </div>
  </div>
@endsection
@section('customJs')
  <script
    src="{{ asset('admin/components/datatables.net/js/jquery.dataTables.min.js') }}">
  </script>
  </script>
  <script src="{{ asset('admin/pages/data-table/js/jszip.min.js') }}"></script>
  <script src="{{ asset('admin/pages/data-table/js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('admin/pages/data-table/js/vfs_fonts.js') }}"></script>
  <script
    src="{{ asset('admin/components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">
  </script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.status_post').on('change', function() {
      var status = $(this).val()
      var itemId = $(this).data('id')
      $.ajax({
        url: '/admin/update/status-post/' + itemId,
        type: 'POST',
        data: {
          status: status
        },
        success: function(response) {
          if (response.status == true) {
            toastr.success("Cập nhật thành công!")
          } else {
            toastr.error("Xảy ra lỗi!")
          }
        }
      })
    })
  </script>
  <script>
    $('#photo').change(function(e) {
      let input = e.target;
      if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
          $("#avatar").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    });
  </script>
@endsection
