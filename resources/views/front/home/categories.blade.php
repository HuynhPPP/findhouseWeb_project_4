<section class="feature-categories bg-white rec-pro">
    <div class="container-fluid">
        <div class="sec-title">
            <h2>Danh mục</h2>
        </div>
        <div class="row">
            <!-- Single category -->
            @foreach ($categories as $category)
                <div class="col-xl-4 col-lg-6 col-sm-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="small-category-2">
                        <div class="small-category-2-thumb img-2">
                            <a href="{{ route('category.posts', $category->id) }}">
                                <img src="{{ asset('front/images/feature-properties/' . $category->category_slug . '.jpg') }}" 
                                     onerror="this.onerror=null; this.src='{{ asset('front/images/feature-properties/house_2.jpg') }}';" 
                                     alt="{{ $category->category_name }}">
                            </a>
                        </div>
                        <div class="sc-2-detail">
                            <h4 class="sc-jb-title">
                                <a href="{{ route('category.posts', $category->id) }}">{{ $category->category_name }}</a>
                            </h4>
                            <span>{{ $category->posts_count }} bài đăng</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- /row -->
    </div>
</section>
