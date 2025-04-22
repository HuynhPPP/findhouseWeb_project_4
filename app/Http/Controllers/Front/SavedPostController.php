<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SavedPost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SavedPostController extends Controller
{
    public function AddToWishlist(Request $request, $post_id)
    {
        if (Auth::check()) {
            $exists = SavedPost::where('user_id', Auth::id())
                ->where('post_id', $post_id)
                ->first();

            if (!$exists) {
                SavedPost::insert([
                    'user_id' => Auth::id(),
                    'post_id' => $post_id,
                    'created_at' => Carbon::now(),
                ]);

                return response()->json([
                    'success' => 'Đã thêm vào mục tin đăng đã lưu',
                    'saved' => true,
                    'heart_class' => 'fas fa-heart',
                    'color' => 'red'
                ]);
            } else {
                // Nếu đã lưu, cho phép xóa hoặc chỉ thông báo trạng thái
                SavedPost::where('user_id', Auth::id())
                    ->where('post_id', $post_id)
                    ->delete();

                return response()->json([
                    'success' => 'Đã xóa khỏi mục tin đăng đã lưu',
                    'saved' => false,
                    'heart_class' => 'far fa-heart',
                    'color' => '' // hoặc màu mặc định
                ]);
            }
        } else {
            return response()->json([
                'error' => 'Bạn cần đăng nhập để lưu bài đăng!',
                'saved' => false,
                'heart_class' => 'far fa-heart',
                'color' => ''
            ]);
        }
    }

    public function UserListSavedPost()
    {
        $userId = Auth::id();
        $savedPosts = SavedPost::where('user_id', $userId)->with('post')->paginate(4);

        $savedPostsCount = SavedPost::where('user_id', $userId)->count();


        return view('front.user.user_savedPost', compact('savedPosts', 'savedPostsCount'));
    }

    public function PosterListSavedPost()
    {
        $userId = Auth::id();
        $savedPosts = SavedPost::where('user_id', $userId)->with('post')->paginate(4);

        $savedPostsCount = SavedPost::where('user_id', $userId)->count();


        return view('front.poster.poster_savedPost', compact('savedPosts', 'savedPostsCount'));
    }

    public function removeSavedPost($id)
    {
        $savedPost = SavedPost::where('id', $id)->where('user_id', Auth::id())->first();

        if ($savedPost) {
            $savedPost->delete();
            return response()->json(['success' => true, 'message' => 'Tin đã được xóa khỏi danh sách.']);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy tin đã lưu.']);
    }

    public function removeSavedPostPoster($id)
    {
        $savedPost = SavedPost::where('id', $id)->where('user_id', Auth::id())->first();

        if ($savedPost) {
            $savedPost->delete();
            return redirect()->route('poster.list.SavedPost')->with([
                'message' => 'Đã xoá khỏi danh sách tin đăng đã lưu!',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('poster.list.SavedPost')->with([
            'message' => 'Không tìm thấy tin đã lưu!',
            'alert-type' => 'error'
        ]);
    }
}
