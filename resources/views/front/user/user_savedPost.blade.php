@extends('front.user.user_dashboard')
@section('user')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
        <div class="col-lg-12 mobile-dashbord dashbord">
            <div class="dashboard_navigationbar dashxl">
                <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10 mr-2"></i> Dashboard
                        Navigation</button>
                    <ul id="myDropdown" class="dropdown-content">
                        <li>
                            <a href="dashboard.html">
                                <i class="fa fa-map-marker mr-3"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="user-profile.html">
                                <i class="fa fa-user mr-3"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a href="my-listings.html">
                                <i class="fa fa-list mr-3" aria-hidden="true"></i>My Properties
                            </a>
                        </li>
                        <li>
                            <a class="active" href="favorited-listings.html">
                                <i class="fa fa-heart mr-3" aria-hidden="true"></i>Favorited Properties
                            </a>
                        </li>
                        <li>
                            <a href="add-property.html">
                                <i class="fa fa-list mr-3" aria-hidden="true"></i>Add Property
                            </a>
                        </li>
                        <li>
                            <a href="payment-method.html">
                                <i class="fas fa-credit-card mr-3"></i>Payments
                            </a>
                        </li>
                        <li>
                            <a href="invoice.html">
                                <i class="fas fa-paste mr-3"></i>Invoices
                            </a>
                        </li>
                        <li>
                            <a href="change-password.html">
                                <i class="fa fa-lock mr-3"></i>Change Password
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <i class="fas fa-sign-out-alt mr-3"></i>Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="my-properties">
            <table class="table-responsive">
                <thead>
                    <tr>
                        <th class="pl-0" style="width: 300px">Danh sách tin đăng đã lưu ({{ $savedPostsCount }})</th>
                        <th class="p-0" style="width: 800px">Tiêu đề bài đăng</th>
                        <th class="p-0"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($savedPosts as $savedPost)
                        <tr>
                            <td class="image myelist">
                                <a href="{{ route('post.detail', $savedPost->post->id) }}">
                                    @if ($savedPost->post->images->count() > 0)
                                        @php
                                            $fixedImage = $savedPost->post->images()->first();
                                        @endphp
                                        <img alt="Hình ảnh bài viết"
                                            src="{{ asset('upload/post_images/' . $fixedImage->image_url) }}"
                                            class="img-fluid" style="height: 150px; width: 220px">
                                    @else
                                        <img alt="Không có ảnh" src="{{ asset('front/upload/no_image.jpg') }}"
                                            class="img-fluid" style="height: 150px; width: 150px">
                                    @endif
                                </a>
                            </td>
                            <td>
                                <div class="inner">
                                    <a href="{{ route('post.detail', $savedPost->post->id) }}">
                                        <h2>{{ $savedPost->post->title }}</h2>
                                    </a>
                                    <figure><i class="lni-map-marker"></i> {{ $savedPost->post->full_address }}</figure>
                                    Người đăng bài: <a href="{{ route('poster.detail', $savedPost->post->user->id) }}"><span
                                            class="text-danger"
                                            style="margin-left: 8px">{{ $savedPost->post->user->name }}</span></a>
                                </div>
                            </td>
                            <td class="actions" style="text-align: left">
                                <a href="#" onclick="removeSavedPost({{ $savedPost->id }})">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Phân trang -->
            <div class="d-flex justify-content-end mt-3">
                {{ $savedPosts->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
