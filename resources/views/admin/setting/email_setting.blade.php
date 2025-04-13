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
  Cài đặt email
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
                <h5>Cài đặt email</h5>
              </div>
              <div class="card-block">
                <form action="{{ route('update.smtp') }}" method="POST">
                  @csrf
                  <input type="hidden" name="id"
                    value="{{ $smtp->id }}">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label col-form-label">Phương thức gửi
                          mail (Mailer)</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('mailer') is-invalid @enderror"
                            id="mailer" name="mailer"
                            value="{{ old('mailer', $smtp->mailer) }}">
                          @error('mailer')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label"> Cổng SMTP
                          (Port)</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('port') is-invalid @enderror"
                            id="port" name="port"
                            value="{{ old('port', $smtp->port) }}">
                          @error('port')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Phương thức mã
                          hóa (Encryption)</label>
                        <select
                          class="border form-select form-control fill @error('encryption') is-invalid @enderror"
                          name="encryption">
                          <option {{ $smtp->encryption == '' ? 'selected' : '' }}
                            value="">Không mã hóa</option>
                          <option
                            {{ $smtp->encryption == 'tls' ? 'selected' : '' }}
                            value="tls">TLS</option>
                          <option
                            {{ $smtp->encryption == 'ssl' ? 'selected' : '' }}
                            value="ssl">SSL</option>
                        </select>
                        @error('encryption')
                          <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Email người
                          gửi</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('from_address') is-invalid @enderror"
                            id="from_address" name="from_address"
                            value="{{ old('from_address', $smtp->from_address) }}">
                          @error('from_address')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label col-form-label">Máy chủ gửi mail
                          (SMTP Host)</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('host') is-invalid @enderror"
                            id="host" name="host"
                            value="{{ old('host', $smtp->host) }}">
                          @error('host')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Tên đăng
                          nhập</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('username') is-invalid @enderror"
                            id="username" name="username"
                            value="{{ old('username', $smtp->username) }}">
                          @error('username')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Mật khẩu</label>
                        <div class="">
                          <input type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password"
                            value="{{ old('password', $smtp->password) }}">
                          @error('password')
                            <span
                              class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
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
@endsection
