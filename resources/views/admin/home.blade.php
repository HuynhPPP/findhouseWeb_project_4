@extends('admin.master')
@section('customCss')
  <link rel="stylesheet" href="{{ asset('admin/css/widget.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/font-awesome-n.min.css') }}">
@endsection
@section('title')
  Tổng quan
@endsection
@section('content')
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="card prod-p-card card-red">
            <div class="card-body">
              <div class="row align-items-center m-b-30">
                <div class="col">
                  <h6 class="text-white m-b-5">Tổng số tin đăng</h6>
                  <h3 class="text-white m-b-0 f-w-700">{{ $posts }}</h3>
                </div>
                <div class="col-auto">
                  <i class="fa fa-location-arrow text-c-red f-18"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card prod-p-card card-blue">
            <div class="card-body">
              <div class="row align-items-center m-b-30">
                <div class="col">
                  <h6 class="text-white m-b-5">Tổng số người dùng</h6>
                  <h3 class="text-white m-b-0 f-w-700">{{ $users }}</h3>
                </div>
                <div class="col-auto">
                  <i class="fa fa-users text-c-blue f-18"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card prod-p-card card-green">
            <div class="card-body">
              <div class="row align-items-center m-b-30">
                <div class="col">
                  <h6 class="text-white m-b-5">Tổng số danh mục</h6>
                  <h3 class="text-white m-b-0 f-w-700">{{ $categories }}</h3>
                </div>
                <div class="col-auto">
                  <i class="feather fa icon-menu text-c-green f-18"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card prod-p-card card-yellow">
            <div class="card-body">
              <div class="row align-items-center m-b-30">
                <div class="col">
                  <h6 class="text-white m-b-5">Tổng số hình ảnh</h6>
                  <h3 class="text-white m-b-0 f-w-700">{{ $images }}</h3>
                </div>
                <div class="col-auto">
                  <i class="fa fa-image text-c-yellow f-18"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-xl-6">
            <div class="card sale-card">
              <div class="card-header">
                <h5>Thống kê tin đăng</h5>
              </div>
              <div class="card-block">
                <canvas class="w-100 h-75" id="postChart"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-xl-6">
            <div class="card sale-card">
              <div class="card-header">
                <h5>Thống kê người dùng</h5>
              </div>
              <div class="card-block">
                <canvas class="w-100 h-75" id="userChart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-12">
          <div class="card new-cust-card">
            <div class="card-header">
              <h5>Tin đăng mới nhất</h5>
            </div>
            <div class="card-block">
              @foreach ($postNew as $item)
                <div class="mb-3 align-middle">
                  <div class="d-inline-block">
                    <a href="{{ route('admin.edit.post', [$item->id, $item->post_slug]) }}"
                      title="{{ $item->title }}">
                      <h6> {{ Str::words(strip_tags($item->title), 8, '...') }}
                      </h6>
                    </a>
                    <p class="text-muted m-b-0">
                      {{ $item->created_at->diffForHumans() }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-12">
          <div class="card new-cust-card">
            <div class="card-header">
              <h5>Người dùng mới nhất</h5>
            </div>
            <div class="card-block">
              @foreach ($userNew as $item)
                <div class="align-middle m-b-35">
                  <img
                    src="{{ $item->photo ? asset('upload/user_images/' . $item->photo) : asset('admin/images/no_image.jpg') }}"
                    alt="user image" class="align-top img-radius img-40 m-r-15">
                  <div class="d-inline-block">
                    <a
                      href="{{ route('admin.edit.renter', ['id' => $item->id]) }}">
                      <h6>{{ $item->name }}</h6>
                    </a>
                    <p class="text-muted m-b-0">
                      {{ $item->created_at->diffForHumans() }}
                    </p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('customJs')
  <script src="{{ asset('admin/js/chart.umd.min.js') }}"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var ctx = document.getElementById('postChart').getContext('2d');
      fetch("{{ url('/admin/chart/posts') }}") // Gọi API từ Laravel
        .then(response => response.json())
        .then(data => {
          var postChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: data.labels, // Nhãn tháng
              datasets: [{
                label: 'Số bài đăng',
                data: data.counts, // Dữ liệu số bài đăng
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        })
        .catch(error => console.error("Lỗi khi tải dữ liệu:", error));
      fetch("/admin/chart/user")
        .then(response => response.json())
        .then(data => {
          var ctx = document.getElementById("userChart").getContext("2d");
          var currentYear = new Date().getFullYear();
          new Chart(ctx, {
            type: "line",
            data: {
              labels: data.labels,
              datasets: [{
                label: `Số lượng người dùng năm ${currentYear}`,
                data: data.data,
                backgroundColor: "rgba(54, 162, 235, 0.2)", // Màu nền
                borderColor: "rgba(54, 162, 235, 1)", // Màu đường kẻ
                borderWidth: 2,
                pointBackgroundColor: "rgba(255, 99, 132, 1)", // Màu điểm tròn
                pointRadius: 5, // Kích thước điểm
                tension: 0.4 // Làm mượt đường cong
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        })
        .catch(error => console.error("Lỗi khi tải dữ liệu:", error));
    });
  </script>
@endsection
