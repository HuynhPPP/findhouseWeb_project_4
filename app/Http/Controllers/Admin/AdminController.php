<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use function Laravel\Prompts\error;

class AdminController extends Controller
{
  public function AdminDashboard()
  {
    return view('admin.home', ['title' => 'Tổng quan']);
  }
  public function AdminProfile()
  {
    $id = Auth::user()->id;
    $adminAccount = User::find($id);
    return view('admin.profile.view_profile', compact('adminAccount'));
  }
  public function AdminStoreUpdateProfile(Request $request)
  {
    $id = Auth::user()->id;
    $file = $request->file('photo');
    $validator = Validator::make($request->all(), [
      'photo' => 'image|mimes:jpg,jpeg,png',
      'name' => 'required|max:200',
      'email' => 'required|email',
      'phone' => 'nullable'
    ], [
      'photo.mimes' => 'Ảnh phải có định dạng jpg, jpeg, hoặc png.',
      'photo.image' => 'Ảnh không hợp lệ.',
      'name.required' => 'Tên là bắt buộc.',
      'name.max' => 'Tên không được vượt quá 200 ký tự.',
      'email.required' => 'Email là bắt buộc.',
      'email.email' => 'Email không hợp lệ.',
      'phone.required' => 'Số điện thoại là bắt buộc.',
      'phone.nullable' => 'Số điện thoại không được để trống nếu có.',
    ]);
    if ($validator->passes()) {
      $data = User::find($id);
      $data->name = $request->name;
      $data->email = $request->email;
      $data->phone = $request->phone;
      if ($file) {
        File::delete(public_path('/admin/upload/' . Auth::user()->photo));
        $fileName = $id . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('admin/upload/'), $fileName);
        $url = public_path('admin/upload/' . $fileName);
        $manager = new ImageManager(new Driver());
        $file = $manager->read($url);
        $file->cover(150, 150);
        $file->save($url);
        $data->photo = $fileName;
      }
      $data->save();
      $notification = array(
        'message' => 'Cập nhật thành công!',
        'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
    } else {
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }
  public function ChangePassword(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'old_password' => 'required',
        'new_password' => [
          'required',
          'min:8',
          'regex:/[A-Z]/',
          'regex:/[a-z]/',
          'regex:/[!@#$%^&*(),.?":{}|<>]/'
        ],
        'confirm_password' => 'required|same:new_password'
      ],
      [
        'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
        'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
        'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
        'new_password.regex' => 'Mật khẩu mới phải chứa ít nhất 1 chữ cái in hoa, 1 chữ cái thường và 1 ký tự đặc biệt.',
        'confirm_password.required' => 'Vui lòng xác nhận mật khẩu mới.',
        'confirm_password.same' => 'Mật khẩu không khớp với mật khẩu mới.',
      ]
    );
    if ($validator->passes()) {
      if (Hash::check($request->old_password, Auth::user()->password) == true) {
        $data = User::find(Auth::user()->id);
        $data->password = Hash::make($request->new_password);
        $data->save();
        return response()->json([
          'status' => true,
          'errors' => [],
        ]);
      } else {
        return response()->json([
          'status' => false,
          'errors' => ['old_password' => 'Mật khẩu cũ không chính xác.']
        ]);
      }
    }
    return response()->json([
      'status' => false,
      'errors' => $validator->errors()
    ]);
  }
}
