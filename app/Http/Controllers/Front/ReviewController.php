<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function StoreReview(Request $request)
    {
        $post_id = $request->post_id;
        $poster_id = $request->poster_id;

        $request->validate([
            'comment' => 'required',
        ]);

        Review::insert([
            'post_id' => $post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->rating,
            'poster_id' => $poster_id,
            'status' => '1',
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Gửi đánh giá thành công',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function PosterReview()
    {
        $userId = auth()->id();

        $reviews = \App\Models\Review::where('poster_id', $userId)
            ->with(['posts', 'user'])
            ->orderBy('id', 'DESC')
            ->get();

        return view('front.poster.review_list', compact('reviews'));
    }

    public function PosterDeleteReview($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return redirect()->back()->with([
                'message' => 'Đánh giá không tồn tại!',
                'alert-type' => 'error'
            ]);
        }

        $review->delete();

        return redirect()->route('poster.review')->with([
            'message' => 'Đánh giá đã được xoá!',
            'alert-type' => 'success'
        ]);
    }

    public function PosterToggleReview($id)
    {
        $review = Review::findOrFail($id);

        // Chuyển đổi trạng thái
        $review->status = $review->status == '1' ? '0' : '1';
        $review->save();

        $message = $review->status == '1' ? 'Đã hiển thị đánh giá này' : 'Đã ẩn đánh giá';

        return response()->json([
            'success' => true,
            'status' => $review->status,
            'message' => $message
        ]);
    }

    public function PosterReviewSort(Request $request)
    {
        $sort = $request->query('sort', 'latest');

        $reviews = Review::with(['user', 'posts'])
            ->when($sort == 'latest', function ($query) {
                return $query->orderBy('created_at', 'desc');
            })
            ->when($sort == 'oldest', function ($query) {
                return $query->orderBy('created_at', 'asc');
            })
            ->get();

        if ($request->ajax()) {
            $reviews_html = view('front.poster.review_sort', compact('reviews'))->render();
            return response()->json(['reviews_html' => $reviews_html]);
        }

        return view('front.poster.review_list', compact('reviews'));
    }
}
