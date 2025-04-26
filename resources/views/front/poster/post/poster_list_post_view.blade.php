@extends('front.poster.poster_dashboard')
@section('poster')
    <title>Danh sách tin đăng</title>
    <style>
        .badge {
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 13px;
            color: white;
        }
    </style>

    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2" style="margin-top: 25px;">
        <div class="my-properties">
            <table class="table-responsive">
                @if ($list_post->isEmpty())
                    <p class="text-center text-muted">Bạn chưa có bài đăng</p>
                @else
                    <thead>
                        <tr>
                            <th class="pl-2">Danh sách tin đăng</th>
                            <th class="p-0"></th>
                            <th>Ngày đăng</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_post as $key => $post)
                            <tr>
                                <td class="image myelist">
                                    <a
                                        href="{{ route('poster.edit.post', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}">
                                        @if ($post->images->count() > 0)
                                            @php
                                                $fixedImage = $post->images()->first();
                                            @endphp
                                            <img alt="Hình ảnh bài viết"
                                                src="{{ asset('upload/post_images/' . $fixedImage->image_url) }}"
                                                class="img-fluid" style="height: 120px; width: 120px">
                                        @else
                                            <img alt="Không có ảnh" src="{{ asset('front/upload/no_image.jpg') }}"
                                                class="img-fluid" style="height: 120px; width: 120px">
                                        @endif
                                    </a>
                                <td>
                                    <div class="inner">
                                        <a
                                            href="{{ route('poster.edit.post', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}">
                                            <h2>{{ Str::words(strip_tags($post->title), 15) }}</h2>
                                        </a>
                                        <figure><i class="lni-map-marker"></i> {{ $post->address }}</figure>

                                        @php
                                            $reviewCount = App\Models\Review::where('post_id', $post->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();

                                            $avarage = App\Models\Review::where('post_id', $post->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp

                                        <ul class="starts text-left mb-0">
                                            @if ($avarage == 0)
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                            @elseif ($avarage == 1 || $avarage < 2)
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                            @elseif ($avarage == 2 || $avarage < 3)
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                            @elseif ($avarage == 3 || $avarage < 4)
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                            @elseif ($avarage == 4 || $avarage < 5)
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star-o"></i>
                                                </li>
                                            @elseif ($avarage == 5 || $avarage < 5)
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                                <li class="mb-0"><i class="fa fa-star"></i>
                                                </li>
                                            @endif

                                            <li class="ml-3">({{ count($reviewCount) }} đánh giá)</li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @switch($post->status)
                                        @case('pending')
                                            <span class="badge badge-warning">Chờ duyệt</span>
                                        @break

                                        @case('approved')
                                            <span class="badge badge-success">Đã duyệt</span>
                                        @break

                                        @case('hidden')
                                            <span class="badge badge-secondary">Đã ẩn</span>
                                        @break

                                        @default
                                            <span class="badge badge-light">Không xác định</span>
                                    @endswitch
                                </td>

                                <td class="actions">
                                    <a href="{{ route('poster.edit.post', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}"
                                        class="edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="{{ route('poster.delete.post', $post->id) }}" id="delete_post">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
            {{-- Pagination links --}}
            <div class="d-flex justify-content-end" style="padding-top: 15px">
                {{ $list_post->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

@section('customJs')
  <script>
    $(function() {
      $(document).on('click', '#delete_post', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
          title: 'Bạn có chắc chắn ?',
          text: "Bạn muốn xóa bài đăng này?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Xoá',
          cancelButtonText: "Huỷ"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
          }
        })
      });
    });
  </script>
@endsection
