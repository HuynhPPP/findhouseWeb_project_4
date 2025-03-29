<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Bookings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function BookingStore(Request $request)
    {
        $existingBooking = Bookings::where('post_id', $request->post_id)
            ->where('user_id', $request->user_id)
            ->first();

        if ($existingBooking) {
            if ($existingBooking->status !== 'cancelled') {
                $notification = [
                    'message' => 'Bạn đã gửi yêu cầu rồi. Vui lòng chờ hoặc huỷ yêu cầu trước đó.',
                    'alert-type' => 'error',
                ];
                return redirect()->back()->with($notification);
            } else {
                // Nếu booking có status 'cancelled', cập nhật lại thành pending
                $existingBooking->update([
                    'status'  => 'pending',
                    'message' => $request->message, // cập nhật message nếu cần
                ]);
                $notification = [
                    'message' => 'Bạn đã gửi yêu cầu thuê. Vui lòng chờ xác nhận từ chủ phòng.',
                    'alert-type' => 'success',
                ];
                return redirect()->back()->with($notification);
            }
        }

        Bookings::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'status'  => 'pending',
        ]);

        $notification = [
            'message'    => 'Gửi yêu cầu thuê thành công! Chờ xác nhận từ chủ phòng',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function cancelBooking($id)
    {
        $booking = Bookings::findOrFail($id);

        // Kiểm tra quyền: chỉ người dùng sở hữu booking mới được huỷ
        if (Auth::id() != $booking->user_id) {
            abort(403, 'Bạn không có quyền huỷ yêu cầu này.');
        }

        // Nếu booking chưa bị huỷ, cập nhật status thành 'cancelled'
        if ($booking->status !== 'cancelled') {
            $booking->update([
                'status' => 'cancelled'
            ]);

            $notification = [
                'message'    => 'Yêu cầu của bạn đã được huỷ.',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message'    => 'Yêu cầu này đã được huỷ trước đó.',
                'alert-type' => 'error',
            ];
        }

        return redirect()->back()->with($notification);
    }
}
