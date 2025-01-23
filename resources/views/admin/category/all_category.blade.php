@extends('admin.master')
@section('customCss')
  <!-- Data Table Css -->
  <link rel="stylesheet" type="text/css"
    href="{{ asset('admin/components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css"
    href="{{ asset('admin/pages/data-table/css/buttons.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css"
    href="{{ asset('admin/components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
      <!-- DOM/Jquery table start -->
      <div class="card">
        <div class="card-header">
          <h5>DOM/Jquery</h5>
          <span>Events assigned to the table can be exceptionally useful for user
            interaction, however you must be aware that DataTables will add and
            remove rows from the DOM as they are needed (i.e. when paging only the
            visible elements are actually available in the DOM). As such, this can
            lead to the odd hiccup when working with events.</span>
        </div>
        <div class="card-block">
          <div class="table-responsive dt-responsive">
            <table id="dom-jqry"
              class="table table-striped table-bordered nowrap">
              <thead>
                <tr>
                  <th>Tên danh mục</th>
                  <th>Trạng thái</th>
                  <th>Ngày tạo</th>
                  <th>Ngày cập nhật</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $item)
                  <tr>
                    <td>{{ $item->category_name }}</td>
                    <td>
                      @if ($item->status == 'show')
                        <label class="form-label label label-success">Hiện</label>
                      @else
                        <label class="form-label label label-success">Ẩn</label>
                      @endif
                    </td>
                    <td>
                      {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                    </td>
                    <td>
                      {{ Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}
                    </td>
                    <td>
                      <a href=""
                        class="btn waves-effect waves-light btn-primary btn-square">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <a href=""
                        class="btn waves-effect waves-light btn-danger btn-square">
                        <i class="fa fa-trash"></i>
                      </a>
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
  <script
    src="{{ asset('admin/components/datatables.net-buttons/js/dataTables.buttons.min.js') }}">
  </script>
  <script src="{{ asset('admin/pages/data-table/js/jszip.min.js') }}"></script>
  <script src="{{ asset('admin/pages/data-table/js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('admin/pages/data-table/js/vfs_fonts.js') }}"></script>
  <script
    src="{{ asset('admin/components/datatables.net-buttons/js/buttons.print.min.js') }}">
  </script>
  <script
    src="{{ asset('admin/components/datatables.net-buttons/js/buttons.html5.min.js') }}">
  </script>
  <script
    src="{{ asset('admin/components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">
  </script>
  <script
    src="{{ asset('admin/components/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
  </script>
  <script
    src="{{ asset('admin/components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
  </script>
  <script>
    $(document).ready(function() {
      $('#dom-jqry').DataTable({
        language: {
          "sProcessing": "Đang xử lý...",
          "sLengthMenu": "Hiển thị _MENU_ mục",
          "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
          "sInfo": "Đang hiển thị _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty": "Đang hiển thị 0 đến 0 của 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix": "",
          "sSearch": "Tìm kiếm:",
          "sUrl": "",
          "oPaginate": {
            "sFirst": "Đầu",
            "sPrevious": "Trước",
            "sNext": "Tiếp",
            "sLast": "Cuối"
          }
        }
      });
    });
  </script>
@endsection
