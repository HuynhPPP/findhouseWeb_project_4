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
                  <th>Tiêu đề</th>
                  <th>Danh mục</th>
                  <th>Giá</th>
                  <th>Diện tích</th>
                  <th>Trạng thái</th>
                  <th>Ngày đăng</th>
                  <th>Ngày cập nhật</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $item)
                  <tr>
                    <td title="{{ $item->title }}">
                      <span class="ellipsis-text">{{ $item->title }}</span>
                    </td>
                    <td>{{ $item->category->category_name }}</td>
                    <td> {{ formatCurrency($item->price) }}</td>
                    <td>
                      {{ fmod((float) $item->area, 1) == 0
                          ? number_format((float) $item->area, 0, '.', ',')
                          : number_format((float) $item->area, 1, '.', ',') }}
                      m&sup2;
                    </td>
                    <td>
                      <form method="POST" class="">
                        @csrf
                        <select data-id="{{ $item->id }}"
                          class="border form-select form-control fill status_post"
                          style="width: fit-content;;" name="status_post">
                          <option
                            {{ $item->status == 'pending' ? 'selected' : '' }}
                            value="pending">Chờ duyệt</option>
                          <option
                            {{ $item->status == 'approved' ? 'selected' : '' }}
                            value="approved">Đã duyệt</option>
                          <option
                            {{ $item->status == 'hidden' ? 'selected' : '' }}
                            value="hidden">Ẩn</option>
                        </select>
                      </form>
                    </td>
          </div>
          </td>
          <td>
            {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
          </td>
          <td>
            {{ Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}
          </td>
          <td>
            <div class="dropdown">
              <button class="border-0 btn btn-primary waves-effect waves-light"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-ellipsis-h" aria-expanded="false"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item"
                    href="{{ route('admin.edit.post', [$item->id, $item->post_slug]) }}">
                    Cập nhật tin đăng
                  </a>
                </li>
                <li><a class="dropdown-item"
                    href="{{ route('admin.edit.post-image', [$item->id, $item->post_slug]) }}">
                    Cập nhật ảnh tin
                  </a>
                </li>
                <li>
                  <form action="{{ route('admin.delete.post', $item->id) }}"
                    class="d-inline deleteForm" role="button" method="post">
                    @method('DELETE')
                    @csrf
                    <a class="delete-sweetalert dropdown-item">
                      Xóa tin đăng
                    </a>
                  </form>
                </li>
              </ul>
            </div>
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
  <script src="{{ asset('admin/pages/data-table/js/data-table-custom.js') }}">
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
@endsection
