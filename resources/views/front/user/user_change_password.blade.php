@extends('front.user.user_dashboard')
@section('user')
    <style>
        .card .btn-block {
            border-radius: 10px;
        }
    </style>

    <div class="col-lg-6 col-md-6 col-xs-6 widget-boxed mt-33 mt-0 offset-lg-2 offset-md-3"
        style="margin-top: 85px !important;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Thay đổi mật khẩu</h5>
                <form id="changePasswordFormUser">
                    @csrf
                    <div class="form-group">
                        <input type="password" class="form-control" id="oldPassword" name="oldPassword"
                            placeholder="Nhập mật khẩu cũ">
                        <small><a href="{{ route('poster.forget.password') }}" class="text-primary">Bạn quên mật
                                khẩu?</a></small>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="newPassword" name="newPassword"
                            placeholder="Nhập mật khẩu mới">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="confirmPassword" name="newPassword_confirmation"
                            placeholder="Xác nhận mật khẩu mới">
                    </div>

                    <button type="submit" class="btn btn-block btn-danger py-2 font-weight-bold">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            $("#changePasswordFormUser").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('user.reset.password') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: "Thành công!",
                            text: response.success,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            $("#changePasswordFormUser")[0].reset();
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors || {};
                        let errorMsg = Object.values(errors).flat().join("<br>");

                        Swal.fire({
                            title: "Lỗi!",
                            html: errorMsg || "Có lỗi xảy ra, vui lòng thử lại.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                });
            });
        });
    </script>
@endsection
