<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;

class SocialliteController extends Controller
{
    public function AuthGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function GoogleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);

                $notification = [
                    'message' => 'Đăng nhập thành công',
                    'alert-type' => 'success',
                ];

                return redirect()->route('index')->with($notification);
            } else {
                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => '',
                    'role' => 'poster',
                    'status' => 'active',
                    'email_verified_at' => Carbon::now(),
                    'google_id' => $googleUser->id,
                    'created_at' => Carbon::now(),
                ]);
            }

            if ($userData) {
                Auth::login($userData);

                $notification = [
                    'message' => 'Đăng nhập thành công',
                    'alert-type' => 'success',
                ];

                return redirect()->route('index')->with($notification);
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
