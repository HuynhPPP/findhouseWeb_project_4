@extends('admin.master')
@section('title')
  Thông tin tài khoản
@endsection
@section('content')
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
      <div class="row">
        <div class="col-sm-12">
          <!-- Bootstrap tab card start -->
          <div class="card">
            <div class="card-header">
              <h5>Tài khoản</h5>
            </div>
            <div class="card-block">
              <!-- Row start -->
              <div class="row">
                <div class="col-lg-12 ">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs  tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" data-bs-toggle="tab"
                        href="#profile" role="tab" aria-selected="true">Thông
                        tin tài khoản</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" data-bs-toggle="tab"
                        href="#change_password" role="tab"
                        aria-selected="false" tabindex="-1">Đổi
                        mật khẩu</a>
                    </li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content tabs card-block">
                    <div class="tab-pane active" id="profile" role="tabpanel">
                      <form id="updateProfile" name="createCategoryForm"
                        class="row"
                        action="{{ route('admin.storeUpdate.profile') }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-lg-12 col-xl-4">
                          <div class="mb-4 card mb-xl-0">
                            <div class="text-center card-body">
                              <div class="col">
                                <img id="avatar" width="150px" height="150px"
                                  class="mb-2 img-account-profile rounded-circle"
                                  src="{{ $adminAccount->photo ? asset('admin/upload/' . $adminAccount->photo) : asset('admin/images/no_image.jpg') }}"
                                  alt="avatar">
                              </div>
                              <div class="col">
                                <input type="file" name="photo"
                                  id="photo"
                                  class="d-none @error('photo') is-invalid @enderror">
                                @error('photo')
                                  <p class="invalid-feedback">{{ $message }}
                                  </p>
                                @enderror
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
                                <label class="form-label col-form-label">Tên quản
                                  trị</label>
                                <input type="text"
                                  class="form-control @error('name') is-invalid @enderror"
                                  id="name"
                                  name="name"value="{{ old('name', $adminAccount->name) }}">
                                @error('name')
                                  <p class="invalid-feedback">{{ $message }}
                                  </p>
                                @enderror
                              </div>
                              <div class="mb-3">
                                <label
                                  class="form-label col-form-label">Email</label>
                                <div class="">
                                  <input type="text"
                                    class="form-control @error('email')is-invalid @enderror"
                                    id="email" name="email"
                                    value="{{ old('name', $adminAccount->email) }}">
                                  @error('email')
                                    <p class="invalid-feedback">{{ $message }}
                                    </p>
                                  @enderror
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label col-form-label">Số điện
                                  thoại</label>
                                <div class="">
                                  <input type="text" class="form-control "
                                    id="phone" name="phone"
                                    value="{{ $adminAccount->phone }}">
                                  <p></p>
                                </div>
                              </div>
                              <button type="submit" class="btn btn-primary">Cập
                                nhật</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane" id="change_password" role="tabpanel">
                      <form id="changePasswordForm" method="POST"
                        class="row justify-content-center">
                        @csrf
                        <div class="col-lg-12 col-xl-6">
                          <div class="card">
                            <div class="card-header">
                              <h5>Tài khoản</h5>
                            </div>
                            <div class="card-block">
                              <div class="mb-3">
                                <label class="form-label col-form-label">Mật khẩu
                                  cũ</label>
                                <input type="password" class="form-control "
                                  id="old_password" name="old_password"
                                  value="">
                                <p></p>
                              </div>
                              <div class="mb-3">
                                <label class="form-label col-form-label">Mật khẩu
                                  mới</label>
                                <div class="">
                                  <input type="password" class="form-control"
                                    id="new_password" name="new_password"
                                    value="">
                                  <p></p>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label col-form-label">Xác nhận
                                  mật khẩu</label>
                                <div class="">
                                  <input type="password" class="form-control "
                                    id="confirm_password"
                                    name="confirm_password" value="">
                                  <p></p>
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
                </div>
              </div>
              <!-- Row end -->
            </div>
          </div>
          <!-- Bootstrap tab card end -->
        </div>
      </div>
    </div>
  </div>
@section('customJs')
  <script>
    $(document).ready(function() {
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
      $('#changePasswordForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        console.log(formData)
        $.ajax({
          type: "POST",
          url: "{{ route('admin.change.password') }}",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(response) {
            console.log(response);
            if (response.status === true) {
              const fields = ['#old_password', '#new_password',
                '#confirm_password'
              ];
              fields.forEach(function(field) {
                $(field).removeClass('is-invalid')
                  .siblings('p')
                  .removeClass('invalid-feedback')
                  .html('');
              });
              $('#old_password').val('');
              $('#new_password').val('');
              $('#confirm_password').val('');
              toastr.success('Cập nhật thành công!');
            } else {
              var errors = response.errors;
              console.log(errors)
              if (errors.old_password) {
                $("#old_password").addClass('is-invalid')
                  .siblings('p')
                  .addClass('invalid-feedback')
                  .html(errors.old_password);
              }
              if (errors.new_password) {
                $("#new_password").addClass('is-invalid')
                  .siblings('p')
                  .addClass('invalid-feedback')
                  .html(errors.new_password);
              }
              if (errors.confirm_password) {
                $("#confirm_password").addClass('is-invalid')
                  .siblings('p')
                  .addClass('invalid-feedback')
                  .html(errors.confirm_password);
              }
            }
          }
        });
      });
    });
  </script>
@endsection
@endsection
