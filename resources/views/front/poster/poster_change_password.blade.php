@extends('front.poster.poster_dashboard')
@section('poster')


<div class="col-lg-6 col-md-6 col-xs-6 widget-boxed mt-33 mt-0 offset-lg-2 offset-md-3" style="margin-top: 85px !important;">
     <div class="my-address">
         <h3 class="heading pt-0">Đổi mật khẩu</h3>
         <form>
             <div class="row">
                 <div class="col-lg-12">
                     <div class="form-group name">
                         <input type="password" name="current-password" class="form-control" placeholder="Nhập mật khẩu cũ">
                     </div>
                     
                 </div>
                 <div class="col-lg-12">
                     <div class="form-group email">
                         <input type="password" name="new-password" class="form-control" placeholder="Nhập mật khẩu mới">
                     </div>
                 </div>
                 <div class="col-lg-12">
                     <div class="send-btn mt-2">
                         <button type="submit" class="btn btn-common">Xác nhận</button>
                         <a href="" style="margin-left: 10px; text-decoration: underline;">Bạn quên mật khẩu ?</a>
                     </div>
                 </div>
             </div>
         </form>
     </div>
 </div>


 @endsection