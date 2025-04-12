@foreach ($reviews as $review)
    @php
        $imagePath = 'upload/user_images/';
        $userPhoto = $review->user->photo ?? null;

        if (!empty($userPhoto)) {
            $imageUrl = url($imagePath . $userPhoto);
        } else {
            $imageUrl = url('upload/no_img.jpg');
        }
    @endphp

    <div class="message">
        <div class="thumb">
            <img class="img-fluid" src="{{ $imageUrl }}" alt="">
        </div>
        <div class="body">
            <h5>{{ $review->posts->title }}</h5>
            <h6>{{ $review->user->name }}</h6>
            <p class="post-time"> {{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</p>
            <p class="content mb-0 mt-2">{{ $review->comment }}</p>
            @if ($review->rating == null)
                <ul class="starts mb-0">
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                </ul>
            @elseif ($review->rating == 1)
                <ul class="starts mb-0">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                </ul>
            @elseif ($review->rating == 2)
                <ul class="starts mb-0">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                </ul>
            @elseif ($review->rating == 3)
                <ul class="starts mb-0">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                </ul>
            @elseif ($review->rating == 4)
                <ul class="starts mb-0">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                </ul>
            @elseif ($review->rating == 5)
                <ul class="starts mb-0">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                </ul>
            @endif
            <div class="controller">
                <ul>
                    <li>
                        <a href="javascript:void(0)" class="toggle-status" data-id="{{ $review->id }}"
                            data-status="{{ $review->status }}">
                            <i class="{{ $review->status == '1' ? 'fa fa-eye' : 'fas fa-eye-slash' }}"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('poster.delete.review', $review->id) }}"
                            id="delete_comment"><i class="far fa-trash-alt"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endforeach