<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChatMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function SendMessage(Request $request)
    {

        $request->validate([
            'newMessage' => 'required'
        ], [
            'newMessage.required' => 'Vui lòng nhập tin nhắn' 
        ]);

        ChatMessage::create([
            'user_id' => Auth::id(), // ID người gửi
            'poster_id' => $request->receiver_id, // ID người nhận
            'post_id' => $request->post_id, // ID bài đăng liên quan
            'message' => $request->newMessage, // Nội dung tin nhắn
            'created_at' => Carbon::now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Message sent successfully']);
    }
}
