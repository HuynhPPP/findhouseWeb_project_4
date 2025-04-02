@extends('front.poster.poster_dashboard')
@section('poster')
    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_post as $key => $post)
                            <tr>
                                <td class="image myelist">
                                    <a href="{{ route('poster.edit.post', $post->id) }}">
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
                                        <a href="{{ route('poster.edit.post', $post->id) }}">
                                            <h2>{{ $post->title }}</h2>
                                        </a>
                                        <figure><i class="lni-map-marker"></i> {{ $post->address }}</figure>
                                        <ul class="starts text-left mb-0">
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
                                            <li class="ml-3">(6 Reviews)</li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                <td class="actions">
                                    <a href="{{ route('poster.edit.post', $post->id) }}" class="edit">
                                        <i class="lni-pencil"></i>Chỉnh sửa</a>
                                    <a href="{{ route('poster.delete.post', $post->id) }}" id="delete_post">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
            <div class="pagination-container">
                <nav>
                    <ul class="pagination">
                        <li class="page-item"><a class="btn btn-common" href="#"><i class="lni-chevron-left"></i>
                                Previous </a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="btn btn-common" href="#">Next <i
                                    class="lni-chevron-right"></i></a></li>
                    </ul>
                </nav>
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
