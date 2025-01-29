@extends('admin.master')
@section('content')
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
      <form id="updateProfile" name="createCategoryForm"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-lg-12 col-xl-4">
            <div class="mb-4 card mb-xl-0">
              <div class="text-center card-body">
                <img id="avatar" class="mb-2 img-account-profile rounded-circle"
                  src="{{ $adminAccount->photo ? asset('admin/upload/' . $adminAccount->photo) : asset('admin/images/no_image.jpg') }}"
                  alt="avatar">
                {{-- <div class="mb-4 small font-italic text-muted"></div> --}}
                <input type="file" name="photo" id="photo"
                  class="d-none">
                <p></p>
                <label for="photo" class="btn btn-primary" type="button">Thay
                  đổi hình ảnh</label>
                @if ($adminAccount->photo)
                  <button type="button" id="remove-photo"
                    class="btn btn-danger">Xóa ảnh</button>
                @endif
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
                  <label class="form-label col-form-label">Tên quản trị</label>
                  <input type="text" class="form-control" id="name"
                    name="name" value="{{ $adminAccount->name }}">
                  <p></p>
                </div>
                <div class="mb-3">
                  <label class="form-label col-form-label">Email</label>
                  <div class="">
                    <input type="text" class="form-control " id="email"
                      name="email" value="{{ $adminAccount->email }}">
                    <p></p>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label col-form-label">Số điện thoại</label>
                  <div class="">
                    <input type="text" class="form-control " id="phone"
                      name="phone" value="{{ $adminAccount->phone }}">
                    <p></p>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
              </div>
            </div>
          </div>
        </div>
      </form>
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
      $('#updateProfile').submit(function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "{{ route('admin.storeUpdate.profile') }}",
          data: $('#updateProfile').serializeArray(),
          dataType: "json",
          success: function(response) {
            if (response.status === true) {
              const fields = ['#photo', '#name', '#email',
                '#phone'
              ];
              fields.forEach(function(field) {
                $(field).removeClass('is-invalid')
                  .siblings('p')
                  .removeClass('invalid-feedback')
                  .html('');
              });
              toastr.success('Cập nhật thành công!');
            } else {
              var errors = response.errors;
              if (errors.photo) {
                $("#photo").addClass('is-invalid')
                  .siblings('p')
                  .addClass('invalid-feedback')
                  .html(errors.photo);
              }
              if (errors.name) {
                $("#name").addClass('is-invalid')
                  .siblings('p')
                  .addClass('invalid-feedback')
                  .html(errors.name);
              }
              if (errors.email) {
                $("#email").addClass('is-invalid')
                  .siblings('p')
                  .addClass('invalid-feedback')
                  .html(errors.email);
              }
            }
          }
        });
      });
    });
  </script>
@endsection
@endsection
