@extends('front.user.user_dashboard')
@section('user')
<title>Danh sách liên hệ</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="pl-0 col-lg-9 col-md-12 col-xs-12 user-dash2" style="margin-top: 25px;">
    <div id="app-chat-box" class="dashborad-box-2">
        <chat-message></chat-message>
    </div>
</div>

@endsection