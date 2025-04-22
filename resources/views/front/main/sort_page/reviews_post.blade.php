@foreach ($reviews as $item)
    @php
        $imagePath = 'upload/user_images/';
        $userPhoto = $item->user->photo ?? null;
        $imageUrl = !empty($userPhoto) ? url($imagePath . $userPhoto) : url('upload/no_img.jpg');
    @endphp

    <div class="row mb-5">
        <ul class="col-12 commented pl-0">
            <li class="comm-inf">
                <div class="col-md-2">
                    <img src="{{ $imageUrl }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-10 comments-info">
                    <div class="conra">
                        <h5 class="mb-2">{{ $item->user->name }}</h5>
                        <div class="rating-box">
                            <div class="detail-list-rating mr-0">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa {{ $i <= $item->rating ? 'fa-star' : 'fa-star-o' }}"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p>{{ $item->created_at->diffForHumans() }}</p>
                    <p>{{ $item->comment }}</p>
                </div>
            </li>
        </ul>
    </div>
@endforeach

<div class="d-flex justify-content-end" style="padding-bottom: 15px">
    {{ $reviews->links('pagination::bootstrap-4') }}
</div>
