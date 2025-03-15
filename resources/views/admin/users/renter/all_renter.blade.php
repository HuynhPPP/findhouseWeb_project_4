@extends('admin.master')
@section('customCss')
  <!-- Data Table Css -->
  <link rel="stylesheet" type="text/css"
    href="{{ asset('admin/components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css"
    href="{{ asset('admin/pages/data-table/css/buttons.dataTables.min.css') }}">
@endsection
@section('content')
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
      <!-- DOM/Jquery table start -->
      <div class="card">
        <div class="card-header">
          <h5>Đăng tin</h5>
        </div>
        <div class="card-block">
          <div class="table-responsive dt-responsive">
            <table id="order-table"
              class="table mt-3 border table-bordered nowrap">
              <thead>
                <tr>
                  <th>Tên</th>
                  <th>Email</th>
                  <th>Số điện thoại</th>
                  <th>Trạng thái</th>
                  <th>Ngày tạo</th>
                  <th>Ngày cập nhật</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($renter as $item)
                  <tr>
                    <td title="{{ $item->name }}">
                      {{ Str::words(strip_tags($item->name), 5, '...') }}
                    </td>
                    <td>{{ $item->email }}</td>
                    <td> {{ $item->phone }}</td>
                    <td>
                      <form method="POST">
                        @csrf
                        <select data-id="{{ $item->id }}"
                          class="border form-select form-control fill status_renter"
                          style="width: fit-content;;" name="status">
                          <option
                            {{ $item->status == 'active' ? 'selected' : '' }}
                            value="active">Hoạt động</option>
                          <option
                            {{ $item->status == 'unactive' ? 'selected' : '' }}
                            value="unactive">Tạm khóa</option>
                        </select>
                      </form>
                    </td>
                    <td>
                      {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                    </td>
                    <td>
                      {{ Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}
                    </td>
                    <td>
                      <a href="{{ route('admin.edit.renter', ['id' => $item->id]) }}"
                        class="btn btn-primary waves-effect waves-light">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <form
                        action="{{ route('admin.delete.renter', ['id' => $item->id]) }}"
                        class="d-inline deleteForm" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="button"
                          class="delete-sweetalert btn waves-effect waves-light btn-danger btn-square">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
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
    $('.status_renter').on('change', function() {
      var status = $(this).val()
      var itemId = $(this).data('id')
      $.ajax({
        url: '/admin/update/status/renter/' + itemId,
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
@endsection
