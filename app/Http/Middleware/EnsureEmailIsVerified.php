<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || is_null(auth()->user()->email_verified_at)) {
            $notification = [
                'message' => 'Bạn cần xác minh email trước khi đăng tin!',
                'alert-type' => 'info',
            ];

            return redirect()->route('poster.verification')->with($notification);
        }

        return $next($request);
    }
}
