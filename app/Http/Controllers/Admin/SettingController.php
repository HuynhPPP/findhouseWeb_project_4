<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  public function SmtpSetting()
  {
    $smtp = SmtpSetting::find(1);
    return view('admin.setting.email_setting', compact('smtp'));
  }
  public function UpdateSmtp(Request $request)
  {
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
