@extends('admin.master')
@section('customCss')
  <!-- Data Table Css -->
  <link rel="stylesheet" type="text/css"
    href="{{ asset('admin/components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css"
    href="{{ asset('admin/pages/data-table/css/buttons.dataTables.min.css') }}">
  <link href="{{ asset('admin/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
    type="text/css" id="app-style" />
  <link rel="stylesheet" href="{{ asset('vendor/flasher/flasher.min.css') }}">
@endsection
@section('title')
  Cài đặt trang
@endsection
@section('content')
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
      <div class="page-body">
        <div class="row">
          <div class="pcoded-inner-content">
            <!-- Date card start -->
            <div class="card">
              <div class="card-header">
                <h5>Cài đặt trang</h5>
              </div>
              <div class="card-block">
                <form action="{{ route('update.site.setting') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id"
                    value="{{ $site_setting->id }}">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label col-form-label">Số điện
                          thoại</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('phone') is-invalid @enderror"
                            id="phone" name="phone"
                            value="{{ old('phone', $site_setting->phone) }}">
                          @error('phone')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Email</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email"
                            value="{{ old('email', $site_setting->email) }}">
                          @error('email')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Địa chỉ</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('address') is-invalid @enderror"
                            id="address" name="address"
                            value="{{ old('address', $site_setting->address) }}">
                          @error('address')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Logo</label>
                        <div class="">
                          <input type="file"
                            class="form-control @error('logo') is-invalid @enderror"
                            id="logo" name="logo"
                            value="{{ old('logo', $site_setting->logo) }}">
                          @error('logo')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label col-form-label">Facebook</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('facebook') is-invalid @enderror"
                            id="facebook" name="facebook"
                            value="{{ old('facebook', $site_setting->facebook) }}">
                          @error('facebook')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Youtube</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('youtube') is-invalid @enderror"
                            id="youtube" name="youtube"
                            value="{{ old('youtube', $site_setting->youtube) }}">
                          @error('youtube')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Copyright</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('copyright') is-invalid @enderror"
                            id="copyright" name="copyright"
                            value="{{ old('copyright', $site_setting->copyright) }}">
                          @error('copyright')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="mb-3">
                        <img id="logo_img" width="100px" height="100px"
                          class="mb-2"
                          src="{{ $site_setting->logo ? asset('front/images/' . $site_setting->logo) : asset('admin/images/no_image.jpg') }}">
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
              </div>
            </div>
            <!-- Date card end -->
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('customJs')
  <script
    src="{{ asset('admin/components/datatables.net/js/jquery.dataTables.min.js') }}">
  </script>
  <script src="{{ asset('admin/pages/data-table/js/jszip.min.js') }}"></script>
  <script src="{{ asset('admin/pages/data-table/js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('admin/pages/data-table/js/vfs_fonts.js') }}"></script>
  <script
    src="{{ asset('admin/components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">
  </script>
  <script src="{{ asset('admin/pages/data-table/js/data-table-custom.js') }}">
  </script>
  <script src="{{ asset('admin/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('admin/sweetalert2/extended-sweetalerts.js') }}">
  </script>
  <script>
    $(document).ready(function() {
      $('#logo').change(function(e) {
        let input = e.target;
        if (input.files && input.files[0]) {
          let reader = new FileReader();
          reader.onload = function(e) {
            $('#logo_img').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      });
    });
  </script>
@endsection
