<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Image;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function UserDashboard()
    {
        return view('front.user.index');
    }

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/user/login');
    }

    public function UserRegister(Request $request)
    {
        $request->merge([
            'name_register' => preg_replace('/\s+/', ' ', trim($request->input('name_register'))),
            'contact_register' => trim($request->input('contact_register')),
            'password_register' => trim($request->input('password_register')),
        ]);

        $messages = [
            'name_register.required' => 'Tên không được để trống.',
            'name_register.regex' => 'Tên không được chứa ký tự đặc biệt.',
            'name_register.max' => 'Tên không được dài quá 20 ký tự.',
            'contact_register.required' => 'Vui lòng nhập email.',
            'contact_register.email' => 'Email không hợp lệ.',
            'contact_register.unique' => 'Email đã tồn tại.',
            'password_register.required' => 'Mật khẩu không được để trống.',
            'password_register.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ];

        // Validation
        $validator = Validator::make($request->all(), [
            'name_register' => [
                'required',
                'regex:/^[\p{L}\s]+$/u',
                'max:20',
            ],
            'contact_register' => [
                'required',
                'email', // Chỉ kiểm tra email
                'unique:users,email', // Kiểm tra unique trong bảng users, cột email
            ],
            'password_register' => ['required', 'min:8'],
        ], $messages);

        // Trả về lỗi nếu validation thất bại
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        // Tạo user mới
        $user = new User([
            'name' => $request->name_register,
            'email' => $request->contact_register, // Chỉ sử dụng email
            'password' => Hash::make($request->password_register),
            'role' => 'user',
            'status' => 'active',
        ]);

        $user->save();

        return response()->json([
            'status' => true,
            'errors' => []
        ], 201);
    }

    public function UserLogin(Request $request)
    {
        // Kiểm tra hợp lệ
        $validator = Validator::make($request->only(['email', 'password']), [
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Vui lòng nhập email.',
            'email.email'       => 'Email không hợp lệ.',
            'password.required' => 'Mật khẩu không được để trống.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Kiểm tra xem email có tồn tại không
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'errors' => ['email' => ['Email không tồn tại !']],
            ]);
        }

        // Xác thực đăng nhập
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status' => false,
                'errors' => ['password' => ['Mật khẩu không chính xác !']],
            ]);
        }

        $request->session()->regenerate();

        // Chuyển hướng dựa trên vai trò người dùng
        $user = Auth::user();
        $redirectUrl = match ($user->role) {
            'admin'  => route('admin.dashboard'),
            'poster' => route('poster.dashboard'),
            'user'   => route('index'),
            default  => route('index'),
        };

        return response()->json([
            'status'       => true,
            'redirect_url' => $request->input('redirect', $redirectUrl),
        ]);
    }

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('front.user.user_profile_view', compact('profileData'));
    }

    public function UserStoreProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $data->photo));
            $filename = 'user_' . $id . '_' . date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Cập nhật thành công',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function UserChangePassword()
    {
        return view('front.user.user_change_password');
    }

    public function ChangePassword(Request $request)
    {
        $messages = [
            'oldPassword.required' => 'Vui lòng nhập mật khẩu cũ.',
            'newPassword.required' => 'Vui lòng nhập mật khẩu mới.',
            'newPassword.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'newPassword.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ];

        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|confirmed',
        ], $messages);

        if (empty($request->oldPassword) && empty($request->newPassword) && empty($request->newPassword_confirmation)) {
            return response()->json(['errors' => ['Vui lòng nhập đầy đủ thông tin.']], 422);
        }

        // Kiểm tra lỗi validate
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $id = Auth::user()->id;
        $user = User::find($id);

        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->oldPassword, $user->password)) {
            return response()->json(['errors' => ['oldPassword' => ['Mật khẩu cũ không đúng.']]], 422);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json([
            'success' => 'Mật khẩu đã được cập nhật thành công.',
            'alert-type' => 'success'
        ]);
    }

    public function UserContacts()
    {
        return view('front.user.user_contacts');
    }
}
