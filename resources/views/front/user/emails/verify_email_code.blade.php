@extends('front.user.user_dashboard')
@section('user')
    <div class="col-lg-6 col-md-6 col-xs-6 widget-boxed mt-33 mt-0 offset-lg-2 offset-md-3"
        style="margin-top: 85px !important;">
        <div class="card p-4">
            <h3 class="text-center font-weight-bold">Nhập mã xác minh</h3>
            <p class="text-center text-muted">Nhập mã xác minh được gửi đến email của bạn</p>


            <form method="POST" action="{{ route('user.email.verify.code') }}">
                @csrf
                <div class="form-group">
                    <label for="verification_code">Mã xác minh</label>
                    <input type="text" id="verification_code" name="verification_code" class="form-control"
                        placeholder="Nhập mã xác minh">
                    @if ($errors->has('verification_code'))
                        <p class="text-danger">{{ $errors->first('verification_code') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-block btn-danger py-2 font-weight-bold">Xác minh →</button>
            </form>
        </div>
    </div>
@endsection
