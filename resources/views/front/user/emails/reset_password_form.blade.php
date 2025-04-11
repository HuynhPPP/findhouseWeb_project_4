@extends('front.user.user_dashboard')
@section('user')
    <div class="col-lg-6 col-md-6 col-xs-6 widget-boxed mt-33 mt-0 offset-lg-2 offset-md-3"
        style="margin-top: 85px !important;">
        <form method="POST" action="{{ route('poster.reset.password') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="password">Mật khẩu mới</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới">
                @if ($errors->has('password'))
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation">Nhập lại mật khẩu</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    placeholder="Nhập lại mật khẩu">
                @if ($errors->has('password_confirmation'))
                    <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>

            <button type="submit" class="btn btn-block btn-success py-2 font-weight-bold">Đặt lại mật khẩu →</button>
        </form>
    </div>
@endsection
