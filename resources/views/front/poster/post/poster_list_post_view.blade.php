@extends('front.poster.poster_dashboard')
@section('poster')

<div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
    <div class="my-properties">
        <table class="table-responsive">
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
                            <a href="single-property-1.html">
                                @if($post->images->count() > 0)
                                    @php
                                        $randomImage = $post->images->random();
                                    @endphp
                                    <img alt="Hình ảnh bài viết" src="{{ asset($randomImage->image_url) }}" class="img-fluid">
                                @else
                                    <img alt="Không có ảnh" src="{{ asset('front/upload/no_image.jpg') }}" class="img-fluid">
                                @endif
                            </a>
                        <td>
                            <div class="inner">
                                <a href="single-property-1.html"><h2>{{ $post->title }}</h2></a>
                                <figure><i class="lni-map-marker"></i> Est St, 77 - Central Park South, NYC</figure>
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
                            <a href="#" class="edit"><i class="lni-pencil"></i>Chỉnh sửa</a>
                            <a href="#"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            <nav>
                <ul class="pagination">
                    <li class="page-item"><a class="btn btn-common" href="#"><i class="lni-chevron-left"></i> Previous </a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="btn btn-common" href="#">Next <i class="lni-chevron-right"></i></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection

@section('customJs')


@endsection