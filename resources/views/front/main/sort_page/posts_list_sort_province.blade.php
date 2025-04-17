@foreach ($posts as $post)
    @php
        $video_url = $post->video_url;
        $video_url_fixed = str_replace('embed/', 'watch?v=', $video_url);
        $fixedImage = $post->images()->first();
        $totalImages = $post->images()->count();
    @endphp
    <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
        <div class="project-single" data-aos="fade-up">
            <div class="project-inner project-head">
                <div class="project-bottom">
                    <h4><a href="{{ route('post.detail', $post->id) }}">Xem chi tiết</a></h4>
                </div>
                <div class="homes">
                    <a href="{{ route('post.detail', $post->id) }}" class="homes-img">
                        <div class="homes-tag button alt sale">{{ $post->category->category_name }}</div>
                        @if ($fixedImage)
                            <img src="{{ asset('upload/post_images/' . $fixedImage->image_url) }}" alt="home-1"
                                class="img-responsive" style="height: 270px;">
                        @else
                            <img src="{{ asset('upload/no_image.jpg') }}" alt="No Image" class="img-responsive">
                        @endif
                    </a>
                </div>
                <div class="button-effect">
                    <a href="#" class="btn copy-link" data-link="{{ route('post.detail', $post->id) }}"><i
                            class="fa fa-link" style="line-height: 30px"></i></a>
                    @if ($video_url)
                        <a href="{{ $video_url_fixed }}" class="btn popup-video popup-youtube"><i class="fas fa-video"
                                style="line-height: 30px"></i></a>
                    @endif
                    <a class="img-poppu btn" style="color: black;">{{ $totalImages }} <i class="fa fa-photo"></i></a>
                </div>
            </div>
            <div class="homes-content">
                <h3><a href="{{ route('post.detail', $post->id) }}">{{ Str::words(strip_tags($post->title), 10) }}</a>
                </h3>
                <p class="homes-address mb-3">
                    <a href="{{ route('post.detail', $post->id) }}">
                        <i class="fa fa-map-marker"></i>
                        <span>{{ $post->full_address }}</span>
                    </a>
                </p>
                <ul class="homes-list clearfix pb-3">
                    <li class="the-icons">
                        <i class="flaticon-square mr-2" aria-hidden="true"></i>
                        <span>{{ $post->area }} m²</span>
                    </li>
                </ul>
                <div class="price-properties">
                    <h3 class="title mt-3">
                        <a href="{{ route('post.detail', $post->id) }}">{{ $post->formatted_price }}/tháng</a>
                    </h3>
                    <div class="compare">
                        <a href="#" title="Chia sẻ" class="share-post"
                            data-link="{{ route('post.detail', $post->id) }}" data-title="{{ $post->title }}"
                            data-post-id="{{ $post->id }}">
                            <i class="fas fa-share-alt"></i>
                        </a>
                        <a href="javascript:void(0)" title="Bấm để lưu tin" id="{{ $post->id }}"
                            onclick="addToWishList(this.id, event)" class="save-post">
                            <i class="{{ $post->isSavedByUser(auth()->user()) ? 'fas fa-heart' : 'far fa-heart' }}"
                                id="heart-icon-{{ $post->id }}"></i>
                        </a>
                    </div>
                </div>
                <div class="footer">
                    <a href="{{ route('poster.detail', $post->user->id) }}">
                        @php
                            $imagePath = 'upload/user_images/';
                            $userPhoto = $post->user->photo ?? null;
                            if (!empty($userPhoto)) {
                                $imageUrl = url($imagePath . $userPhoto);
                            } else {
                                $imageUrl = url('upload/no_img.jpg');
                            }
                        @endphp
                        <img src="{{ $imageUrl }}" alt="User Image" class="mr-2"
                            style="width: 35px; height: 35px; object-fit: cover; border-radius: 50%;">
                        {{ $post->user->name }}
                    </a>
                    <span
                        style="margin-top: 7px">{{ \Carbon\Carbon::parse($post->created_at)->locale('vi')->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
@endforeach
