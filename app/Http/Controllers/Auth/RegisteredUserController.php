<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                'regex:/^[\p{L}\s]+$/u', // Chỉ cho phép chữ cái và khoảng trắng
                'max:20',
                function ($attribute, $value, $fail) {
                    $cleanedValue = preg_replace('/\s+/', ' ', trim($value));
                    if ($cleanedValue !== $value) {
                        $fail('Tên không hợp lệ !.');
                    }
                },
            ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'min:8',
                'regex:/^(?!\d+$).+$/', // Không cho phép chỉ chứa số
                'confirmed'
            ],
            'phone' => ['required', 'regex:/^(0[3|5|7|8|9])+([0-9]{8})$/'], // Số điện thoại Việt Nam 10 số
            'account_type' => ['required', 'in:user,poster'],
        ], [
            'name.required' => 'Tên không được để trống.',
            'name.regex' => 'Tên không được chứa ký tự đặc biệt.',
            'name.max' => 'Tên không được dài quá 20 ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu không được chỉ chứa số.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại không hợp lệ !',
            'account_type.required' => 'Vui lòng chọn loại tài khoản.',
            'account_type.in' => 'Loại tài khoản không hợp lệ.',
        ]);
    
        $user = User::create([
            'name' => preg_replace('/\s+/', ' ', trim($request->name)), // Chuẩn hóa tên
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->account_type,
            'created_at' => Carbon::now(),
        ]);
    
        Auth::login($user);
    
        return redirect(RouteServiceProvider::HOME);
    }
}
