<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
  public function SiteSetting()
  {
    $site_setting = SiteSetting::find(1);
    return view('admin.setting.site_setting', compact('site_setting'));
  }
  public function UpdateSiteSetting(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'phone' => 'regex:/^0[0-9]{9}$/',
        'phone' => 'phone:VN',
        'email' => 'required|email',
        'facebook' => 'required|url',
        'youtube' => 'required|url',
        'address' => 'required|max:255',
        'copyright' => 'required|max:255',
      ],
      [
        'regex' => 'Số điện thoại không hợp lệ.',
        'phone' => 'Số điện thoại không hợp lệ.',
        'email.email' => 'Định dạng email không hợp lệ.',
        'email.required' => 'Vui lòng nhập email.',
        'facebook.required' => 'Vui lòng nhập đường dẫn Facebook.',
        'facebook.url' => 'Đường dẫn Facebook không hợp lệ.',
        'copyright.required' => 'Vui lòng nhập thông tin bản quyền.',
        'copyright.max' => 'Thông tin bản quyền không được vượt quá 255 ký tự.',
        'address.required' => 'Vui lòng nhập địa chỉ.',
        'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        'youtube.required' => 'Vui lòng nhập đường dẫn YouTube.',
        'youtube.url' => 'Đường dẫn YouTube không hợp lệ.',
      ]
    );
    if ($validator->passes()) {
      $id_site = $request->id;
      $file_img = $request->file('logo');
      $data = SiteSetting::find($id_site);
      $data->phone = $request->phone;
      $data->email = $request->email;
      $data->facebook = $request->facebook;
      $data->youtube = $request->youtube;
      $data->copyright = $request->copyright;
      $data->address = $request->address;
      if ($file_img) {
        File::delete(public_path('/front/images/' . $data->logo));
        $file_name = $id_site . '-' . time() . '.' . $file_img->getClientOriginalExtension();
        $file_img->move(public_path('/front/images/'), $file_name);
        $url = public_path('/front/images/' . $file_name);
        $manager = new ImageManager(new Driver());
        //dd($url);
        $file_img = $manager->read($url);
        // $file_img->cover(250, 250);
        $file_img->save($url);
        $data->logo = $file_name;
      }
      $data->save();
      $notification = array(
        'message' => 'Cập nhật thành công!',
        'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
    }
    return redirect()->back()->withErrors($validator)->withInput();;
  }
}
