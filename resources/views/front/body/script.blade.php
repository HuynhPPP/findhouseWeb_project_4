<style>
    .swal2-popup.swal2-toast {
        margin-top: 95px !important;
    }

    .swal2-container {
        z-index: 99999 !important;
    }
</style>

{{-- Login --}}
<script>
    $(document).ready(function() {
        $("#loginForm").submit(function(e) {
            e.preventDefault();

            let submitButton = $(".log-submit-btn");
            submitButton.prop("disabled", true);
            $(".error-message").html("");
            $("input").removeClass("input-error");

            $.ajax({
                url: '{{ route('user.login') }}',
                type: 'post',
                data: $('#loginForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {
                    submitButton.prop("disabled", false);

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if (response.status === false) {
                        $.each(response.errors, function(field, messages) {
                            $("#" + field + "_error").html(messages[0]);
                            $("#" + field).addClass("input-error");
                        });
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Đăng nhập thành công! Đang chuyển hướng...'
                        });

                        setTimeout(() => {
                            window.location.href = response.redirect_url;
                        }, 1500);
                    }
                },
                error: function(xhr) {
                    submitButton.prop("disabled", false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Có lỗi xảy ra!',
                        text: 'Vui lòng thử lại sau.',
                    });
                }
            });
        });
    });
</script>

{{-- Register --}}
<script>
    $(function() {
        const $form = $("#registrationForm");
        const $submitBtn = $form.find('.log-submit-btn');
        let isSubmitting = false;

        // Cấu hình Toast
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $form.on('submit', function(e) {
            e.preventDefault();

            if (isSubmitting) {
                return;
            }
            isSubmitting = true;

            $submitBtn.prop('disabled', true).html('<span>Đang xử lý...</span>');

            $.ajax({
                url: '{{ route('user.register') }}',
                type: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                success: function(response) {
                    // Reset trạng thái lỗi
                    $(".error-message").empty();
                    $form.find('input').removeClass('input-error');

                    if (response.status === false) {
                        $.each(response.errors, function(field, messages) {
                            $("#" + field + "_error").html(messages[0]);
                            $("#" + field).addClass("input-error");
                        });
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Đăng ký thành công !'
                        });
                    }
                },
                error: function(xhr) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Đã xảy ra lỗi hệ thống. Vui lòng thử lại.'
                    });
                },
                complete: function() {
                    isSubmitting = false;
                    $submitBtn.prop('disabled', false).html('<span>Đăng ký</span>');
                }
            });
        });
    });
</script>

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
