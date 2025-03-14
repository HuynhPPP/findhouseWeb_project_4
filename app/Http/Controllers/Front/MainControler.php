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
use Illuminate\Support\Facades\DB;
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

            $post->formatted_price = $this->formatPrice($post->price);

            return $post;
        });

        $posts_newest = Post::where('status', 'approved')
            ->orderBy('created_at', 'desc') 
            ->take(8)
            ->get()
            ->map(function ($post) {
                $addressParts = array_filter([
                    $post->house_number,
                    $post->street,
                    $post->ward,
                    $post->district,
                    $post->province
                ]);

                $post->full_address = implode(', ', $addressParts);
                $post->formatted_price = $this->formatPrice($post->price);

                return $post; // Trả về đối tượng đã được cập nhật trong map()
            });


        $categories = Category::where('status', 'show')->get();


        return view(
            'front.main.index',
            compact('posts_featured', 'categories', 'posts_newest')
        );
    }

    // Hàm định dạng giá tiền
    private function formatPrice($price)
    {
        if ($price >= 1000000) {
            return round($price / 1000000, 1) . ' triệu';
        } else {
            return number_format($price, 0, ',', '.') . ' đồng';
        }
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

            $post->formatted_price = $this->formatPrice($post->price);

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

        $addressParts = array_filter([
            $post->house_number,
            $post->street,
            $post->ward,
            $post->district,
            $post->province
        ]);

        $post->full_address = implode(', ', $addressParts);

        $post->formatted_price = $this->formatPrice($post->price);

        $images = $post->images;

        return view('front.main.post_detail', compact('post', 'images'));
    }

    public function getPostsByCategory($id)
    {
        $posts_category = Post::where('category_id', $id)->take(9)->get()->map(function ($post) {
            $addressParts = array_filter([
                $post->house_number,
                $post->street,
                $post->ward,
                $post->district,
                $post->province
            ]);

            $post->full_address = implode(', ', $addressParts);
            $post->formatted_price = $this->formatPrice($post->price);

            return $post; // Trả về đối tượng đã được cập nhật trong map()
        });

        // Lấy thông tin danh mục một lần duy nhất
        $category = Category::find($id);

        return view('front.main.all_post_category', compact('posts_category', 'category'));
    }
}
