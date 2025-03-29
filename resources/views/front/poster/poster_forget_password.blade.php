@extends('front.poster.poster_dashboard')
@section('poster')
    <style>
        .card {
            width: 100%;
            border-radius: 8px;
            border: none;
        }

        .btn-danger {
            border-radius: 6px;
            font-size: 18px;
        }

        #email {
            height: 50px;
        }
    </style>

    <div class="col-lg-6 col-md-6 col-xs-6 widget-boxed mt-33 mt-0 offset-lg-2 offset-md-3"
        style="margin-top: 85px !important;">

        <div class="card  p-4">
            <h3 class="text-center font-weight-bold">Khôi phục mật khẩu</h3>
            <p class="text-center text-muted">Nhập Email của bạn để nhận mã đặt lại mật khẩu</p>
            @php
                $id = Auth::user()->id;
                $profileData = App\Models\User::find($id);
            @endphp

            <form method="POST" action="{{ route('password.password.code') }}" id="forgetPassForm">
                @csrf
                <div class="form-group">
                    <label for="phone">Email</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{ $profileData->email }}">
                </div>

                <button type="submit" id="submitBtnForget" class="btn btn-block btn-danger py-2 font-weight-bold">Tiếp tục →</button>

                <!-- Thông báo đang xử lý -->
                <div id="loadingMessageForget" class="text-center mt-3" style="display: none;">
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
    document.getElementById("forgetPassForm").addEventListener("submit", function() {
        // Ẩn nút bấm
        document.getElementById("submitBtnForget").style.display = "none";

        // Hiển thị thông báo "Đang xử lý..."
        document.getElementById("loadingMessageForget").style.display = "block";
    });
</script>
@endsection
