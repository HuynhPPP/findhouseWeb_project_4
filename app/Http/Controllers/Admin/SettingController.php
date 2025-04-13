<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
  public function SmtpSetting()
  {
    $smtp = SmtpSetting::find(1);
    return view('admin.setting.email_setting', compact('smtp'));
  }
  public function UpdateSmtp(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'mailer'   => 'required|in:smtp,sendmail,mailgun,ses,log,failover',
      'host'     => 'required|string',
      'port'     => 'required|integer',
      'username' => 'required|string',
      'password' => 'required|string',
      'encryption' => 'nullable|in:tls,ssl',
      'from_address' => 'required|email'
    ], [
      'mailer.required'   => 'Vui lòng chọn phương thức gửi email.',
      'mailer.in'         => 'Phương thức gửi email không hợp lệ.',
      'host.required'     => 'Vui lòng nhập Mail Host.',
      'port.required'     => 'Vui lòng nhập Mail Port.',
      'from_address.required'     => 'Vui lòng nhập email.',
      'from_address.email'     => 'Địa chỉ email không hợp lệ.',
      'port.integer'      => 'Port phải là số.',
      'username.required' => 'Vui lòng nhập tên đăng nhập Mail.',
      'password.required' => 'Vui lòng nhập mật khẩu Mail.',
      'encryption.in' => 'Phương thức mã hóa không hợp lệ. Chỉ chấp nhận tls hoặc ssl.',
    ]);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }
    $smtp_id = $request->id;
    SmtpSetting::find($smtp_id)->update([
      'mailer' =>  $request->mailer,
      'host' =>  $request->host,
      'port' =>  $request->port,
      'username' =>  $request->username,
      'password' =>  $request->password,
      'encryption' =>  $request->encryption,
      'from_address' =>  $request->from_address,
    ]);
    $notification = array(
      'message' => 'Cập nhật thành công!',
      'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
  }
}
