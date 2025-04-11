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
                            value="{{ $smtp->mailer }}">
                          <p></p>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label"> Cổng SMTP
                          (Port)</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('port') is-invalid @enderror"
                            id="port" name="port"
                            value="{{ $smtp->port }}">
                          <p></p>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Phương thức mã
                          hóa (Encryption)</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('encryption') is-invalid @enderror"
                            id="encryption" name="encryption"
                            value="{{ $smtp->encryption }}">
                          <p></p>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Email người
                          gửi</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('from_address') is-invalid @enderror"
                            id="from_address" name="from_address"
                            value="{{ $smtp->from_address }}">
                          <p></p>
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
                            value="{{ $smtp->host }}">
                          <p></p>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Tên đăng
                          nhập</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('username') is-invalid @enderror"
                            id="username" name="username"
                            value="{{ $smtp->username }}">
                          <p></p>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label col-form-label">Mật khẩu</label>
                        <div class="">
                          <input type="text"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password"
                            value="{{ $smtp->password }}">
                          <p></p>
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
  <script>
    $(document).ready(function() {
      function getCategory() {
        $.ajax({
          method: "GET",
          url: "{{ route('admin.get.categoryCreate') }}",
          success: function(response) {
            let html = '';
            response.forEach(function(item, index) {
              const itemId = item.id;
              const deleteUrl =
                `{{ route('admin.delete.category', ':id') }}`
                .replace(':id', itemId);
              html +=
                `
               <tr>
                  <th scope="row">${index+1}</th>
                  <td>${item.category_name}</td>
                  <td>
                  ${item.status==='show' ?'<label class="form-label label label-success">Hiện</label>' :' <label class="form-label label label-warning">Ẩn</label>'}
                  </td>
                  <td>
                    ${new Date(item.created_at).toLocaleDateString('vi-VN')}
                  </td>
                   <td>
                      <a href="/edit/category/${item.id}/${item.category_slug}.html"
                        class="btn waves-effect waves-light btn-primary btn-square">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <form
                       action="${deleteUrl}"
                        class="d-inline deleteForm" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="button"
                          class="delete btn waves-effect waves-light btn-danger btn-square">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>
                    </td>
                </tr>
              `;
            });
            $('#data-category').html(html);
            const deleteButton = document.querySelectorAll(
              ".delete");
            deleteButton.forEach((item) =>
              item.addEventListener("click", function(t) {
                Swal.fire({
                  title: "Bạn có muốn xóa không?",
                  text: "Bạn sẽ không thể khôi phục lại!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  cancelButtonText: "Hủy bỏ",
                  confirmButtonText: "Ok",
                }).then((result) => {
                  if (result.isConfirmed) {
                    this.closest("form").submit();
                  }
                });
              })
            );
          }
        });
      }
      getCategory()
      $("#createCategoryForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
          url: "{{ route('admin.storeCreate.category') }}",
          type: 'POST',
          dataType: 'json',
          data: $("#createCategoryForm").serializeArray(),
          success: function(response) {
            if (response.status == true) {
              $("#category_name").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
              $("#category_name").val('');
              toastr.success('Thêm danh mục thành công!');
              getCategory()
            } else {
              var errors = response.errors;
              if (errors.category_name) {
                $("#category_name").addClass('is-invalid')
                  .siblings('p')
                  .addClass('invalid-feedback')
                  .html(errors.category_name);
              }
            }
          }
        })
      })
    });
  </script>
  <script src="{{ asset('admin/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('admin/sweetalert2/extended-sweetalerts.js') }}">
  </script>
@endsection
