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
          <h5>Đăng tin</h5>
        </div>
        <div class="card-block">
          <div class="table-responsive dt-responsive">
            <table id="order-table" class="table border table-bordered nowrap">
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
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category->category_name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->area }}</td>
                    <td>
                      @if ($item->status == 'pending')
                        <label class="form-label label label-warning">Chờ
                          duyệt</label>
                      @elseif ($item->status == 'approved')
                        <label class="form-label label label-success">Đã
                          duyệt</label>
                      @elseif ($item->status == 'rejected')
                        <label class="form-label label label-danger">Hủy
                          bỏ</label>
                      @else
                        <label class="form-label label label-danger">Ẩn</label>
                      @endif
                    </td>
                    <td>
                      {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                    </td>
                    <td>
                      {{ Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}
                    </td>
                    <td>
                      <div class="dropdown">
                        <button
                          class="border-0 btn btn-primary waves-effect waves-light"
                          type="button" data-bs-toggle="dropdown"
                          aria-expanded="false">
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
                            <form
                              action="{{ route('admin.delete.post', $item->id) }}"
                              class="d-inline deleteForm" role="button"
                              method="post">
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
