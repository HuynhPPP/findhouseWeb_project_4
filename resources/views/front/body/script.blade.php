{{-- <script>
    function addToWishList(postId, event) {
        event.preventDefault();

        // Gửi yêu cầu AJAX để thêm/xóa bài đăng khỏi danh sách yêu thích
        $.ajax({
            url: '/save-post/' + postId, // Đường dẫn để lưu hoặc xóa bài đăng
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Token bảo mật
                post_id: postId
            },
            success: function(response) {
                // Kiểm tra xem bài đăng đã được lưu hay chưa
                if (response.saved) {
                    // Thay đổi biểu tượng thành trái tim đỏ
                    $('#' + postId + ' i').removeClass('fa-heart-o').addClass('fa-heart').css('color',
                        'red');
                } else {
                    // Thay đổi biểu tượng thành trái tim rỗng
                    $('#' + postId + ' i').removeClass('fa-heart').addClass('fa-heart-o').css('color', '');
                }
            },
            error: function() {
                alert('Có lỗi xảy ra!');
            }
        });
    }
</script> --}}


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    function addToWishList(post_id, event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/add-to-wishlist/" + post_id,
            cache: false,

            success: function(data) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                const heartIcon = $('#heart-icon-' + post_id);

                if (data.success) {
                    Toast.fire({
                        icon: 'success',
                        title: data.success,
                    });
                    heartIcon.removeClass('far fa-heart fas fa-heart')
                        .addClass(data.heart_class)
                        .css('color', data.color);
                } else if (data.error) {
                    Toast.fire({
                        icon: 'error',
                        title: data.error,
                    });
                    heartIcon.removeClass('far fa-heart fas fa-heart')
                        .addClass(data.heart_class)
                        .css('color', data.color);
                }
            },

            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Có lỗi xảy ra!',
                    text: 'Vui lòng thử lại sau.',
                });
                // Đảm bảo biểu tượng không thay đổi khi có lỗi server
                const heartIcon = $('#heart-icon-' + post_id);
                heartIcon.removeClass('far fa-heart fas fa-heart')
                    .addClass('far fa-heart')
                    .css('color', ''); // Màu mặc định
            }
        });
    }
</script>

<script type="text/javascript">
    function removeSavedPost(savedPostId) {
        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Tin này sẽ bị xóa khỏi danh sách đã lưu!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Xóa",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/user/remove-saved-post/" + savedPostId,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire("Xóa thành công!", response.message, "success");
                            location.reload();
                        } else {
                            Swal.fire("Lỗi!", response.message, "error");
                        }
                    }
                });
            }
        });
    }
</script>

<script type="text/javascript">
    function removeSavedPostPoster(savedPostId) {
        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Tin này sẽ bị xóa khỏi danh sách đã lưu!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Xóa",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/poster/remove-saved-post/" + savedPostId,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire("Xóa thành công!", response.message, "success");
                            location.reload();
                        } else {
                            Swal.fire("Lỗi!", response.message, "error");
                        }
                    }
                });
            }
        });
    }
</script>

<style>
    .swal2-popup.swal2-toast {
        margin-top: 95px !important;
    }
</style>
