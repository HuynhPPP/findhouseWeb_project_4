<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Image;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class MainControler extends Controller
{
    public function Index()
    {
        $posts_featured = Post::where('is_featured', '1')->take(6)->get()->map(function ($post) {
            $addressParts = array_filter([
                $post->house_number,
                $post->street,
                $post->ward,
                $post->district,
                $post->province
            ]);
            $post->full_address = implode(', ', $addressParts);
            return $post;
        });

        return view(
            'front.main.index',
            compact('posts_featured')
        );
    }

    public function AllPostRecommend()
    {
        $posts_all_featured = Post::where('is_featured', '1')->take(9)->get()->map(function ($post) {
            $addressParts = array_filter([
                $post->house_number,
                $post->street,
                $post->ward,
                $post->district,
                $post->province
            ]);
            $post->full_address = implode(', ', $addressParts);
            return $post;
        });

        return view(
            'front.main.all_post_recommend',
            compact('posts_all_featured')
        );
    }

    public function PostDetail($id)
    {
        // Lấy bài đăng theo ID
        $post = Post::findOrFail($id);

        return view('front.main.post_detail', compact('post'));
    }
}
