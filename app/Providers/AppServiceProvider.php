<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use App\Models\SmtpSetting;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
    {
        // Thiết lập cấu hình SMTP nếu bảng smtp_settings tồn tại
        if (Schema::hasTable('smtp_settings')) {
            $smtpsetting = SmtpSetting::first();
            if ($smtpsetting) {
                $data = [
                    'driver' => $smtpsetting->mailer,
                    'host' => $smtpsetting->host,
                    'port' => $smtpsetting->port,
                    'username' => $smtpsetting->username,
                    'password' => $smtpsetting->password,
                    'encryption' => $smtpsetting->encryption,
                    'from' => [
                        'address' => $smtpsetting->from_address,
                        'name' => 'FindHouse',
                    ],
                ];
                Config::set('mail', $data);
            }
        }

        // Cập nhật thời gian truy cập cuối cùng của người dùng
        View::composer('*', function ($view) {
            if (Auth::check()) {
                DB::table('users')->where('id', Auth::id())->update([
                    'last_seen' => now(),
                ]);
            }
        });
    }


}
