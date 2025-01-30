<div class="login-and-register-form modal">
    <div class="main-overlay"></div>
    <div class="main-register-holder">
        <div class="main-register fl-wrap">
            <div class="close-reg"><i class="fa fa-times"></i></div>
            <h3><span>Find<strong>Houses</strong></span></h3>
            <div class="soc-log fl-wrap">
                <p>Đăng nhập</p>
                <a href="#" class="facebook-log"><i class="fa fa-facebook-official"></i>Đăng nhập bằng Facebook</a>
                <a href="#" class="twitter-log"><i class="fa fa-twitter"></i> Đăng nhập bằng Google</a>
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
                            <form method="POST" action="{{ route('login') }}" name="registerform">
                                @csrf
                                <label>Email hoặc số điện thoại * </label>
                                <input name="email" :value="old('email')"
                                       id="email" 
                                       type="text"
                                       class="@error('email') is-invalid @enderror" 
                                       onClick="this.select()" 
                                       value=""
                                >
                                @error('email')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                                <label>Mật khẩu * </label>
                                <input name="password" 
                                       class="@error('password') is-invalid @enderror"
                                       id="password" 
                                       type="password" 
                                       onClick="this.select()"
                                >
                                @error('password')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
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
                                <form method="post" name="registerform" class="main-register-form" id="main-register-form2">
                                    <label>Họ tên * </label>
                                    <input name="name" type="text" onClick="this.select()" value="">
                                    <label>Email hoặc số điện thoại *</label>
                                    <input name="email" type="text" onClick="this.select()" value="">
                                    <label>Mật khẩu *</label>
                                    <input name="password" type="password" onClick="this.select()" value="">
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