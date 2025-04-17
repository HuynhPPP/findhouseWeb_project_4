@extends('front.poster.poster_dashboard')
@section('poster')
    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
        <div class="my-properties" id="list-post">
            @include('front.poster.post.sort_page_poster.list_post_sort')
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(function() {
            $(document).on('click', '#delete_post', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");
                Swal.fire({
                    title: 'Bạn có chắc chắn ?',
                    text: "Bạn muốn xóa bài đăng này?",
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

    <script>
        $(document).ready(function() {
            // Bắt sự kiện click vào link phân trang trong review
            $(document).on('click', '#list-post .pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                fetchReviews(url);
            });

            function fetchReviews(url) {
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        $('#list-post').html(data);
                    },
                    error: function() {
                        Toast.fire({
                            icon: 'error',
                            title: 'Không thể tải đánh giá!'
                        });
                    }
                });
            }
        });
    </script>
@endsection
