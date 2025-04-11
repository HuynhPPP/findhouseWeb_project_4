<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\ChatMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validation
        $request->validate([
            'newMessage' => 'required|string|max:1000',
            'receiver_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);

        // Kiểm tra xem người gửi có quyền nhắn tin cho bài đăng không
        $post = Post::findOrFail($request->post_id);
        if ($post->user_id != $request->receiver_id && $post->user_id != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Bạn không có quyền nhắn tin cho bài đăng này'], 403);
        }

        // Lưu tin nhắn
        $message = ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'post_id' => $request->post_id,
            'message' => $request->newMessage,
            'created_at' => Carbon::now(),
        ]);

        // Eager load quan hệ
        $message->load(['sender', 'receiver']);

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function getAllUsers()
    {
        $userId = Auth::id();
        $chats = ChatMessage::with(['sender', 'receiver', 'post', 'post.images'])
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        $groupedChats = $chats->groupBy('post_id')->map(function ($chatGroup, $postId) use ($userId) {
            // Lấy danh sách người gửi/receiver (ngoại trừ user hiện tại)
            $users = $chatGroup->map(function ($chat) use ($userId) {
                return $chat->sender_id === $userId ? $chat->receiver : $chat->sender;
            })->unique('id')->values();

            // Lấy bài đăng
            $post = $chatGroup->first()->post;

            // Lấy tin nhắn mới nhất
            $latestMessage = $chatGroup->sortByDesc('created_at')->first();

            return [
                'post' => $post,
                'users' => $users,
                'latest_message' => $latestMessage,
            ];
        });

        return response()->json($groupedChats->values());
    }

    public function getMessagesByPostId($postId)
    {
        $messages = ChatMessage::where('post_id', $postId)
            ->where(function ($query) {
                $query->where('sender_id', Auth::id())
                    ->orWhere('receiver_id', Auth::id());
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'ASC')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }
}
