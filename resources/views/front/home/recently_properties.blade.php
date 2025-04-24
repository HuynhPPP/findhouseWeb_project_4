<section class="featured portfolio rec-pro disc">
  <div class="container-fluid">
    <div class="sec-title discover">
      <h2>Tin mới đăng</h2>
    </div>
    <div class="portfolio col-xl-12">
      <div class="slick-lancers">
        @foreach ($posts_newest as $post)
          @php
            $video_url = $post->video_url;
            $video_url_fixed = str_replace('embed/', 'watch?v=', $video_url);

                        $fixedImage = $post->images()->first();
                        $totalImages = $post->images()->count();
                    @endphp

                    <div class="agents-grid" data-aos="fade-up" data-aos-delay="150">
                        <div class="landscapes">
                            <div class="project-single">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="single-property-1.html" class="homes-img">
                                            <div class="homes-tag button alt featured">Mới nhất</div>
                                            <div class="homes-tag button alt sale">{{ $post->category->category_name }}
                                            </div>
                                            @if ($fixedImage)
                                                <img src="{{ asset('upload/post_images/' . $fixedImage->image_url) }}"
                                                    alt="home-1" class="img-responsive" style="height: 320px;">
                                            @else
                                                <img src="{{ asset('upload/no_image.jpg') }}" alt="No Image"
                                                    class="img-responsive" style="height: 270px;">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a class="btn copy-link"
                                            data-link="{{ route('post.detail', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}"><i class="fa fa-link"
                                                style="line-height: 30px"></i></a>
                                        @if ($video_url)
                                            <a href="{{ $video_url_fixed }}" class="btn popup-video popup-youtube"><i
                                                    class="fas fa-video" style="line-height: 30px"></i></a>
                                        @endif
                                        <a class="img-poppu btn">
                                            {{ $totalImages }} <i class="fa fa-photo"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3>
                                        <a href="{{ route('post.detail', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}">
                                            {{ Str::words(strip_tags($post->title), 10) }}
                                        </a>
                                    </h3>
                                    <p class="homes-address mb-3">
                                        <a href="{{ route('post.detail', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}">
                                            <i class="fa fa-map-marker"></i>
                                            <span>
                                                {{ $post->full_address }}
                                            </span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix pb-3">
                                        <li class="the-icons">
                                            <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                            <span>{{ $post->area }} m&sup2;</span>
                                        </li>
                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="{{ route('post.detail', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}">
                                                @if ($post->price >= 1000000)
                                                    {{ number_format($post->price / 1000000, 1) }} triệu/tháng
                                                @else
                                                    {{ number_format($post->price, 0, ',', '.') }} đồng/tháng
                                                @endif
                                            </a>
                                        </h3>
                                        <div class="compare">
                                            <a href="#" title="Chia sẻ" class="share-post"
                                                data-link="{{ route('post.detail', ['id' => $post->id, 'post_slug' => $post->post_slug]) }}"
                                                data-title="{{ $post->title }}" data-post-id="{{ $post->id }}">
                                                <i class="fas fa-share-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" title="Bấm để lưu tin"
                                                id="{{ $post->id }}" onclick="addToWishList(this.id, event)"
                                                class="save-post">
                                                <i class="{{ $post->isSavedByUser(auth()->user()) ? 'fas fa-heart' : 'far fa-heart' }}"
                                                    id="heart-icon-{{ $post->id }}"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
