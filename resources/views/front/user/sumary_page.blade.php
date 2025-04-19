@extends('front.user.user_dashboard')
@section('user')
    <style>
        .stat-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 30px;
            text-align: center;
        }

        .stat-icon {
            font-size: 36px;
            margin-bottom: 10px;
            color: #4A90E2;
        }

        .stat-number {
            font-size: 26px;
            font-weight: bold;
        }

        .stat-label {
            font-size: 14px;
            color: #777;
        }
    </style>

    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
        <div class="dashborad-box stat bg-white">
            <h4 class="title">Thống kê tin đăng</h4>
            <div class="section-body">
                <div class="row">

                    {{-- Tin đã phê duyệt --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="stat-number">{{ $approvedPosts }}</div>
                            <div class="stat-label">Tin đã phê duyệt</div>
                        </div>
                    </div>

                    {{-- Tin đang chờ duyệt --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fa fa-clock"></i>
                            </div>
                            <div class="stat-number">{{ $pendingPosts }}</div>
                            <div class="stat-label">Tin chờ phê duyệt</div>
                        </div>
                    </div>

                    {{-- Tin đã lưu --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="stat-number">{{ $savedCount }}</div>
                            <div class="stat-label">Tin đã được lưu</div>
                        </div>
                    </div>

                    {{-- Tin nhắn liên hệ --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <div class="stat-number">{{ $messagesCount }}</div>
                            <div class="stat-label">Người liên hệ</div>
                        </div>
                    </div>

                    {{-- Tổng đánh giá --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="stat-number">{{ $reviewsCount }}</div>
                            <div class="stat-label">Tổng đánh giá</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="dashborad-box stat bg-white">
            <h4 class="title">Danh sách bài viết gần đây</h4>

            @if (Auth::user()->email_verified_at)
                <div class="table-responsive-2">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Ngày đăng</th>
                                <th>Đề xuất</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentPosts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        @if ($post->is_featured == 1)
                                            ✅
                                        @else
                                            ❌
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->status == 'approved')
                                            <span class="badge badge-success">Đã duyệt</span>
                                        @else
                                            <span class="badge badge-secondary">Chưa duyệt</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted px-3 py-2">Vui lòng xác minh tài khoản để có thể đăng tin.</p>
            @endif
        </div>

    </div>
@endsection
