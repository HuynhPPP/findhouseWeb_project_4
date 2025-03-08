<style>
    .error-message {
        color: red;
        font-size: 14px;
        margin-bottom: 20px;
        display: block;
    }

    .input-error {
        border: 1px solid red;
        background-color: #ffe6e6;
        /* Nhẹ nhàng báo lỗi */
    }
</style>


<div class="login-and-register-form modal">
    <div class="main-overlay"></div>
    <div class="main-register-holder">
        <div class="main-register fl-wrap">
            <div class="close-reg"><i class="fa fa-times"></i></div>
            <h3><span>Find<strong>Houses</strong></span></h3>
            <div class="soc-log fl-wrap">
                <p>Đăng nhập</p>
                <a href="#0" class="social_bt google">Đăng nhập bằng Google</a>
            </div>
            <div class="log-separator fl-wrap"><span>Hoặc</span></div>
            <div id="tabs-container">
                <ul class="tabs-menu">
                    <li class="current"><a href="#tab-1">Đăng nhập</a></li>
                    <li><a href="#tab-2">Đăng ký</a></li>
                </ul>
                <div class="tab">
                    <div id="tab-1" class="tab-contents">
                        <div class="custom-form">
                            <form method="POST" name="registerform" id="loginForm">
                                @csrf
                                <label>Email hoặc số điện thoại</label>
                                <input name="contact" type="text" id="contact" value="{{ old('contact') }}">
                                <span id="contact_error" class="error-message"></span>
                                <label>Mật khẩu</label>
                                <input name="password" id="password" type="password">
                                <span id="password_error" class="error-message"></span>
                                <button type="submit" class="log-submit-btn"><span>Đăng nhập</span></button>
                                <div class="clearfix"></div>
                                <div class="filter-tags">
                                    <input id="check-a" type="checkbox" name="check">
                                    <label for="check-a">Ghi nhớ tôi</label>
                                </div>
                            </form>
                            <div class="lost_password">
                                <a href="#">Quên mật khẩu?</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab">
                        <div id="tab-2" class="tab-contents">
                            <div class="custom-form">
                                <form method="POST" name="registerform" class="main-register-form" id="registrationForm">
                                    @csrf
                                    <label>Họ tên</label>
                                    <input id="name" name="name" type="text" value="{{ old('name') }}">
                                    <span id="name_error_register" class="error-message"></span>

                                    <label>Email hoặc số điện thoại</label>
                                    <input id="contact_register" name="contact" type="text"
                                        value="{{ old('contact') }}">
                                    <span id="contact_error_register" class="error-message"></span>


                                    <label>Mật khẩu</label>
                                    <input id="password_register" name="password" type="password">
                                    {{-- <div id="password-strength" style="font-size: 14px; margin-top: 3px;"></div> --}}
                                    <span id="password_error_register" class="error-message"></span>

                                    <label>Loại tài khoản</label>
                                    <div>
                                        <input type="radio" name="account_type" value="user"
                                            {{ old('account_type') == 'user' ? 'checked' : '' }}>
                                        <span style="margin-right: 5px">Tìm kiếm</span>
                                        <input type="radio" name="account_type" value="poster"
                                            {{ old('account_type') == 'poster' ? 'checked' : '' }}>
                                        <span>Chính chủ</span>
                                    </div>
                                    <span id="account_type_error_register" class="error-message"></span>

                                    <button type="submit" class="log-submit-btn"><span>Đăng ký</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('customJs')
    <script>
        $("#registrationForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('user.register') }}',
                type: 'post',
                data: $('#registrationForm').serialize(),
                dataType: 'json',
                success: function(response) {
                    $(".error-message").html(""); // Xóa lỗi cũ
                    $("#registrationForm input").removeClass(
                        "input-error"); // Chỉ ảnh hưởng đến đăng ký

                    if (response.status === false) {
                        $.each(response.errors, function(field, messages) {
                            let errorField = $("#" + field +
                                "_error_register"); // Chọn lỗi đúng form
                            let inputField = $("#registrationForm [name='" + field + "']");

                            if (errorField.length) {
                                errorField.html(messages[0]); // Hiển thị lỗi
                            }
                            if (inputField.length) {
                                inputField.addClass("input-error"); // Tô viền đỏ input lỗi
                            }
                        });
                    } else {
                        window.location.href = '{{ route('index') }}';
                    }
                }
            });
        });
    </script>

    <script>
        $("#loginForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('user.login') }}',
                type: 'post',
                data: $('#loginForm').serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $(".error-message").html("");
                    $("input").removeClass("input-error");

                    if (response.status === false) {
                        $.each(response.errors, function(field, messages) {
                            let errorField = $("#" + field + "_error");
                            if (errorField.length) {
                                errorField.html(messages[0]);
                            }
                            $("#" + field).addClass("input-error");
                        });
                    } else {
                        window.location.href = response.redirect_url;
                    }
                }
            });
        });
    </script>
@endsection
