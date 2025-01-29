<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
  public function AdminDashboard()
  {
    return view('admin.home');
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
      'photo' => 'nullable|mimes:jpg,jpeg,png|max:10240',
      'name' => 'required|max:200',
      'email' => 'required|email',
      'phone' => 'nullable'
    ], [
      'photo.mimes' => 'Ảnh phải có định dạng jpg, jpeg, hoặc png.',
      'photo.max'   => 'Ảnh không được lớn hơn 10MB.',
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
        $data->photo = $fileName;
      }
      $data->save();
      // $notification = array(
      //   'message' => 'Cập nhật thành công!',
      //   'alert-type' => 'success'
      // );
      // return redirect()->back()->with($notification);
      session()->flash('toastr', ['success' => 'Cập nhật thành công!']);
      return response()->json([
        'status' => true,
        'errors' => [],
      ]);
    }
    return response()->json([
      'status' => false,
      'errors' =>  $validator->errors()
    ]);
  }
}
