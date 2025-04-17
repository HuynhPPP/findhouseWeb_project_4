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
                                <h2>{{ $post->title }}</h2>
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
                    <td class="actions">
                        <a href="{{ route('poster.edit.post', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}"
                            class="edit">
                            <i class="lni-pencil"></i> Chỉnh sửa
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