@extends('front.user.user_dashboard')
@section('user')
    <div class="col-lg-6 col-md-6 col-xs-6 widget-boxed mt-33 mt-0 offset-lg-2 offset-md-3"
        style="margin-top: 85px !important;">

        <div class="card p-4">
            <h3 class="text-center font-weight-bold">Xác minh Email</h3>
            <p class="text-center text-muted">Nhập Email của bạn để xác minh</p>
            @php
                $id = Auth::user()->id;
                $profileData = App\Models\User::find($id);
            @endphp

            <form method="POST" action="{{ route('user.email.verify') }}" id="verifyEmailForm">
                @csrf
                <div class="form-group">
                    <label for="phone">Email</label>
                    <input type="text" id="email" name="email" class="form-control"
                        value="{{ $profileData->email }}">
                    @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <button type="submit" id="submitBtn" class="btn btn-block btn-danger py-2 font-weight-bold">Lấy mã
                    →</button>

                <!-- Thông báo đang xử lý -->
                <div id="loadingMessage" class="text-center mt-3" style="display: none;">
                    <div class="spinner-border text-danger" role="status">
                        <span class="sr-only">Đang xử lý...</span>
                    </div>
                    <p class="text-muted">Đang xử lý yêu cầu, vui lòng đợi...</p>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('customJs')
    <script>
        document.getElementById("verifyEmailForm").addEventListener("submit", function() {
            // Ẩn nút bấm
            document.getElementById("submitBtn").style.display = "none";

            // Hiển thị thông báo "Đang xử lý..."
            document.getElementById("loadingMessage").style.display = "block";
        });
    </script>
@endsection