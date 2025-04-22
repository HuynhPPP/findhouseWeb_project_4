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
            <h6 style="color: #FF385C">{{ $review->user->name }}</h6>
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
                        <a href="{{ route('poster.delete.review', $review->id) }}" id="delete_comment"><i
                                class="far fa-trash-alt"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endforeach

<script>
    $(document).ready(function() {
        $('.toggle-status').on('click', function(e) {
            e.preventDefault();

            var reviewId = $(this).data('id');
            var currentStatus = $(this).data('status');
            var icon = $(this).find('i');

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $.ajax({
                url: '{{ route('review.toggle.status', ':id') }}'.replace(':id', reviewId),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Cập nhật biểu tượng
                        if (response.status == '1') {
                            icon.removeClass('fas fa-eye-slash').addClass('fa fa-eye');
                        } else {
                            icon.removeClass('fa fa-eye').addClass('fas fa-eye-slash');
                        }
                        // Cập nhật data-status
                        $(this).data('status', response.status);
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                    }
                }.bind(this),
                error: function(xhr) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Đã có lỗi xảy ra. Vui lòng thử lại!'
                    });
                }
            });
        });
    });
</script>

<script>
    $(function() {
        $(document).on('click', '#delete_comment', function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            Swal.fire({
                title: 'Bạn có chắc chắn ?',
                text: "Bạn muốn xoá đánh giá này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xoá',
                cancelButtonText: "Huỷ"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link
                }
            })
        });
    });
</script>
