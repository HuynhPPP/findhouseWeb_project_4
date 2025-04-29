@foreach ($reviews as $item)
    @php
        $imagePath = 'upload/user_images/';
        $userPhoto = $item->user->photo ?? null;
        $imageUrl = !empty($userPhoto) ? url($imagePath . $userPhoto) : url('upload/no_img.jpg');
    @endphp

    <div class="row mb-5">
        <ul class="col-12 commented pl-0">
            <li class="comm-inf d-flex flex-wrap">
                <div class="col-md-2">
                    <img src="{{ $imageUrl }}" class="img-fluid rounded-circle" alt="User Image">
                </div>
                <div class="col-md-10 comments-info">
                    <div class="conra d-flex justify-content-between align-items-center">
                        <a href="{{ route('post.detail', ['id' => $item->posts->id, 'post_slug' => $item->posts->post_slug]) }}">
                            <p class="mb-2">
                                {{ Str::words(strip_tags($item->posts->title), 20) }}
                            </p>
                        </a>
                        <div class="rating-box">
                            <div class="detail-list-rating mr-0">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa {{ $i <= $item->rating ? 'fa-star' : 'fa-star-o' }}"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="mb-2 text-muted">
                        <i class="fa fa-user" style="margin-right: 10px"></i> {{ $item->user->name }}
                    </p>
                    <p>{{ $item->comment }}</p>
                </div>
            </li>
        </ul>
    </div>
@endforeach

{{-- Pagination links --}}
<div class="d-flex justify-content-end" style="padding-bottom: 15px">
    {{ $reviews->links('pagination::bootstrap-4') }}
</div>
