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
        $reviews = Review::orderBy('id','DESC')->get();

        return view('front.poster.review_list', compact('reviews'));
    }
}
