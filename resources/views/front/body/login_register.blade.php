<style>
    .error-message {
        color: red;
        font-size: 15px;
        margin-bottom: 20px;
        display: block;
    }

    .input-error {
        border: 1px solid red;
        background-color: #ffe6e6;
    }
</style>


<div class="login-and-register-form modal">
    <div class="main-overlay"></div>
    <div class="main-register-holder">
        <div class="main-register fl-wrap">
            <div class="close-reg"><i class="fa fa-times" style="line-height: 40px;"></i></div>
            <h3><span>Find<strong>Houses</strong></span></h3>
            <div class="soc-log fl-wrap">
                <p>Đăng nhập</p>
                <a href="{{ route('auth.google') }}" class="social_bt google">Đăng nhập bằng Google</a>
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
                            <form method="POST"id="loginForm">
                                @csrf
                                <label>Email</label>
                                <input name="email" type="email" id="email" value="{{ old('email') }}">
                                <span id="email_error" class="error-message text-danger"></span>
                                <label>Mật khẩu</label>
                                <input name="password" id="password" type="password">
                                <span id="password_error" class="error-message"></span>
                                <button type="submit" class="log-submit-btn"><span>Đăng nhập</span></button>
                                <div class="clearfix"></div>
                            </form>
                            <div class="lost_password">
                                <a href="#">Quên mật khẩu?</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab">
                        <div id="tab-2" class="tab-contents">
                            <div class="custom-form">
                                <form method="POST" class="main-register-form" id="registrationForm">
                                    @csrf
                                    <label>Họ tên</label>
                                    <input id="name" name="name_register" type="text" value="{{ old('name') }}">
                                    <span id="name_register_error" class="error-message"></span>

                                    <label>Email </label>
                                    <input id="contact_register" name="contact_register" type="email"
                                        value="{{ old('contact') }}">
                                    <span id="contact_register_error" class="error-message"></span>


                                    <label>Mật khẩu</label>
                                    <input id="password_register" name="password_register" type="password">
                                    {{-- <div id="password-strength" style="font-size: 14px; margin-top: 3px;"></div> --}}
                                    <span id="password_register_error" class="error-message"></span>


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
