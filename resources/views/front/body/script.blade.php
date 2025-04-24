<style>
    .swal2-popup.swal2-toast {
        margin-top: 95px !important;
    }

    .swal2-container {
        z-index: 99999 !important;
    }
</style>

<script>
    $('#loginForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: '/user/login',
            method: 'POST',
            data: $(this).serialize(), // bao gồm cả hidden `redirect`
            success: function(response) {
                if (response.status) {
                    let redirectUrl = new URL(response.redirect_url);
                    redirectUrl.searchParams.set('logged_in', 1); // gắn query param
                    window.location.href = redirectUrl.toString();
                } else {
                    // xử lý lỗi hiển thị
                }
            }
        });
    });
</script>

{{-- Login --}}
<script>
    $(document).ready(function() {
        $("#loginForm").submit(function(e) {
            e.preventDefault();

            let submitButton = $(".log-submit-btn");
            submitButton.prop("disabled", true).html('<span>Đang xử lý...</span>');
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

                        // Nếu là tài khoản bị khóa
                        if (response.account_locked) {
                            Swal.fire({
                                icon: 'error',
                                text: response.message,
                            });
                            submitButton.prop("disabled", false).html(
                                '<span>Đăng nhập</span>');
                            return;
                        }

                        $.each(response.errors, function(field, messages) {
                            $("#" + field + "_error").html(messages[0]);
                            $("#" + field).addClass("input-error");
                        });
                        submitButton.prop("disabled", false).html('<span>Đăng nhập</span>');
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
                    submitButton.prop("disabled", false).html('<span>Đăng nhập</span>');


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

{{-- Add to WishList --}}
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

{{-- Remove WishList --}}
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

<!-- Get link post -->
<script>
    document.querySelectorAll('.copy-link').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            const link = this.getAttribute('data-link');
            navigator.clipboard.writeText(link).then(() => {
                Toast.fire({
                    icon: 'success',
                    title: 'Đã sao chép liên kết'
                });
            }).catch(err => {
                console.error('Lỗi khi sao chép: ', err);
                Toast.fire({
                    icon: 'error',
                    title: 'Không thể sao chép liên kết!'
                });
            });
        });
    });
</script>
