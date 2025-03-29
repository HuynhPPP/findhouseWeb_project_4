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
    public function SendMessage(Request $request)
    {
        $message = ChatMessage::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'post_id'     => $request->post_id,
            'message'     => $request->newMessage,
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    public function GetAllUsers()
    {
        $chats = ChatMessage::with(['sender', 'receiver', 'post', 'post.images'])
            ->where(function ($query) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            })
            ->orderBy('id', 'DESC')
            ->get();

        $groupedChats = $chats->groupBy('post_id');

        // Với mỗi nhóm (mỗi bài đăng), gom lại danh sách user (người mà user hiện tại đã trò chuyện)
        $result = $groupedChats->map(function ($chatGroup, $postId) {
            // Lấy danh sách các user đã trò chuyện (ngoại trừ user hiện tại)
            $users = $chatGroup->flatMap(function ($chat) {
                // Nếu tin nhắn được gửi bởi người đăng nhập (sender_id)
                if ($chat->sender_id === auth()->id()) {
                    return [$chat->receiver];
                }
                // Ngược lại, nếu tin nhắn được gửi bởi đối phương
                return [$chat->sender];
            })->unique('id')->values();

            // Lấy thông tin bài đăng từ tin nhắn đầu tiên của nhóm
            $post = $chatGroup->first()->post;

            return [
                'post'     => $post,
                'users'    => $users,
                'messages' => $chatGroup,  // Tất cả các tin nhắn liên quan đến bài đăng này
            ];
        });

        return response()->json($result->values());
    }

    public function UserMsgById($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $messages = ChatMessage::where(function ($q) use ($userId) {
                $q->where('sender_id', auth()->id())
                    ->where('receiver_id', $userId);
            })->orWhere(function ($q) use ($userId) {
                $q->where('sender_id', $userId)
                    ->where('receiver_id', auth()->id());
            })->with('user')->get();

            return response()->json([
                'user' => $user,
                'messages' => $messages
            ]);
        } else {
            abort(404);
        }
    }

    public function getMessagesByPostId($postId)
    {
        // Lấy tất cả tin nhắn thuộc về post_id
        // và có tham gia của user hiện tại (auth()->id())
        $messages = ChatMessage::where('post_id', $postId)
            ->where(function ($query) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            })
            ->with(['sender', 'receiver']) // eager load quan hệ cần thiết
            ->orderBy('id', 'ASC')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages
        ]);
    }
}
