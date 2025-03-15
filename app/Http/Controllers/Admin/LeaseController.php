<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class LeaseController extends Controller
{
  public function AllLease()
  {
    $lease = User::where('role', 'poster')->get();
    return view('admin.users.lease.all_lease', compact('lease'));
  }
  public function EditLease($id)
  {
    $lease = User::findOrFail($id);
    return view('admin.users.lease.edit_lease', compact('lease'));
  }
  public function StoreLease(Request $request)
  {
    $file = $request->file('photo');
    $validator = Validator::make($request->all(), [
      'photo' => 'image|mimes:jpg,jpeg,png',
      'name' => 'required|max:200',
      'email' => 'required|email',
      'phone' => 'nullable',
      'phone' => 'required'
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
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }
    $data = User::findOrFail($request->id);
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    if ($file) {
      File::delete(public_path('upload/user_images/' . $data->photo));
      $fileName = 'avatar' . '-' .  time() . '.' . $file->getClientOriginalExtension();
      $file->move(public_path('upload/user_images/'), $fileName);
      $url = public_path('upload/user_images/' . $fileName);
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
    // dd($request->id);
  }
  public function DeleteLease($id)
  {
    $lease = User::findOrFail($id);
    if ($lease == null) {
      $notification = array(
        'message' => 'Tin đăng không tồn tại!',
        'alert-type' => 'error'
      );
      return redirect()->back()->with($notification);
    } else {
      $lease->delete();
      $notification = array(
        'message' => 'Xóa tin đăng thành công!',
        'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
    }
  }
  public function UpdateStatusLease(Request $request, $id)
  {
    $lease = User::findOrFail($id);
    $lease->update([
      'status' => $request->status,
    ]);
    return response()->json([
      'status' => true,
      'errors' => [],
    ]);
  }
}
