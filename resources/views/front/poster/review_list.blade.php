@extends('front.poster.poster_dashboard')
@section('poster')
    <style>
        .dashborad-box {
            max-height: 100vh;
            overflow: auto;
        }
    </style>

    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
        <div class="dashborad-box">
            <h4 class="title">Danh sách đánh giá ({{ $reviews->count() }})</h4>
            <div class="section-body">
                <div class="messages">

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
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                    </ul>
                                @elseif ($review->rating == 1)
                                    <ul class="starts mb-0">
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                    </ul>
                                @elseif ($review->rating == 2)
                                    <ul class="starts mb-0">
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                    </ul>
                                @elseif ($review->rating == 3)
                                    <ul class="starts mb-0">
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                    </ul>
                                @elseif ($review->rating == 4)
                                    <ul class="starts mb-0">
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                    </ul>
                                @elseif ($review->rating == 5)
                                    <ul class="starts mb-0">
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                @endif
                                <div class="controller">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="#"><i class="far fa-trash-alt"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
@endsection
