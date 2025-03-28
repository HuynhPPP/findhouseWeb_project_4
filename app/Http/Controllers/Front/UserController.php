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
            'name' => preg_replace('/\s+/', ' ', trim($request->input('name'))),
        ]);

        $messages = [
            'name.required' => 'Tên không được để trống.',
            'name.regex' => 'Tên không được chứa ký tự đặc biệt.',
            'name.max' => 'Tên không được dài quá 20 ký tự.',
            'contact.required' => 'Vui lòng nhập email hoặc số điện thoại.',
            'contact.email_or_phone' => 'Email hoặc số điện thoại không hợp lệ.',
            'contact.unique' => 'Email hoặc số điện thoại đã tồn tại trong hệ thống.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'account_type.required' => 'Vui lòng chọn loại tài khoản.',
            'account_type.in' => 'Loại tài khoản không hợp lệ.',
        ];

        Validator::extend('email_or_phone', function ($attribute, $value, $parameters, $validator) {
            return filter_var($value, FILTER_VALIDATE_EMAIL) || preg_match('/^(0[3|5|7|8|9])+([0-9]{8})$/', $value);
        });

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'regex:/^[\p{L}\s]+$/u', // Chỉ cho phép chữ cái và khoảng trắng
                'max:20',
            ],
            'contact' => [
                'required',
                'email_or_phone', // Kiểm tra nếu là email hợp lệ hoặc số điện thoại
                function ($attribute, $value, $fail) {
                    // Kiểm tra nếu là email
                    if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        if (User::where('email', $value)->exists()) {
                            $fail('Email đã tồn tại.');
                        }
                    }
                    // Kiểm tra nếu là số điện thoại
                    elseif (preg_match('/^(0[3|5|7|8|9])+([0-9]{8})$/', $value)) {
                        if (User::where('phone', $value)->exists()) {
                            $fail('Số điện thoại đã tồn tại.');
                        }
                    }
                }
            ],
            'password' => [
                'required',
                'min:8',
            ],
            'account_type' => ['required', 'in:user,poster'],
        ], $messages);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;

            if (filter_var($request->contact, FILTER_VALIDATE_EMAIL)) {
                $user->email = $request->contact;
                $user->phone = null;
            } else {
                $user->phone = $request->contact;
                $user->email = null;
            }
            $user->password = Hash::make($request->password);
            $user->role = $request->input('account_type', 'user');
            $user->save();

            session()->flash('message', 'Đăng ký thành công');
            session()->flash('alert-type', 'success');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function UserLogin(Request $request)
    {
        $messages = [
            'contact.required' => 'Vui lòng nhập email hoặc số điện thoại.',
            'password.required' => 'Mật khẩu không được để trống.',
        ];

        $validator = Validator::make($request->all(), [
            'contact' => 'required',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $credentials = [];
        if (filter_var($request->contact, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->contact;
        } else {
            $credentials['phone'] = $request->contact;
        }
        $credentials['password'] = $request->password;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Xác định đường dẫn chuyển hướng mặc định dựa trên quyền
            $defaultUrl = '';
            if (Auth::user()->role === 'admin') {
                $defaultUrl = route('admin.dashboard');
            } elseif (Auth::user()->role === 'poster') {
                $defaultUrl = route('poster.dashboard');
            } elseif (Auth::user()->role === 'user') {
                $defaultUrl = route('index');
            }

            // Kiểm tra tham số redirect từ request
            $redirectUrl = $request->input('redirect') ? $request->input('redirect') : $defaultUrl;

            return response()->json([
                'status'       => true,
                'redirect_url' => $redirectUrl,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => [
                    'password' => ['Tài khoản hoặc mật khẩu không đúng.']
                ],
            ]);
        }
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
            $filename = date('YmdHi') . $file->getClientOriginalName();
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

    public function UserContacts()
    {
        return view('front.user.user_contacts');
    }
}
