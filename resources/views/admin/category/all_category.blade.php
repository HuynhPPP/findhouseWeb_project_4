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
          <h5>Danh mục</h5>
        </div>
        <div class="card-block">
          <div class="table-responsive dt-responsive">
            <table id="order-table"
              class="table table-striped table-bordered nowrap">
              <thead>
                <tr>
                  <th>Tên danh mục</th>
                  <th>Slug</th>
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
                    <td>{{ $item->category_slug }}</td>
                    <td>
                      @if ($item->status == 'show')
                        <label class="form-label label label-success">Hiện</label>
                      @else
                        <label class="form-label label label-warning">Ẩn</label>
                      @endif
                    </td>
                    <td>
                      {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                    </td>
                    <td>
                      {{ Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}
                    </td>
                    <td>
                      <a href="{{ route('admin.edit.category', [$item->id, $item->category_slug]) }}"
                        class="btn waves-effect waves-light btn-primary btn-square">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <form
                        action="{{ route('admin.delete.category', $item->id) }}"
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
@endsection
