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
        $posts_featured = Post::where('is_featured', '1')
            ->take(6)
            ->get()
            ->each(function ($post) {
                $post->formatted_price = $this->formatPrice($post->price);
            });

        $posts_newest = Post::where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get()
            ->each(function ($post) {
                $post->formatted_price = $this->formatPrice($post->price);
            });

        $categories = Category::where('status', 'show')->get();

        return view('front.main.index', compact('posts_featured', 'categories', 'posts_newest'));
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

    public function SearchPost(Request $request)
    {
        $query = Post::query();
        $search_keyword = null;

        if ($request->filled('keyword')) {
            $search_keyword = trim($request->keyword);
            $query->where(function ($q) use ($search_keyword) {
                $q->where('title', 'LIKE', "%$search_keyword%")
                    ->orWhere('price', 'LIKE', "%$search_keyword%")
                    ->orWhere('area', 'LIKE', "%$search_keyword%")
                    ->orWhere('province', 'LIKE', "%$search_keyword%")
                    ->orWhere('district', 'LIKE', "%$search_keyword%")
                    ->orWhere('ward', 'LIKE', "%$search_keyword%");
            });
        }

        if ($request->filled('category') && $request->category != '-- Danh mục --') {
            $query->where('category_id', $request->category);
        }

        $posts = $query->paginate(9);

        return view('front.main.search_results', compact('posts', 'search_keyword'));
    }

    public function FilterPost(Request $request)
    {

        // Lấy dữ liệu từ request
        $provinceName = $request->input('province_name'); // Tên tỉnh
        $districtName = $request->input('district_name'); // Tên huyện
        $wardName = $request->input('ward_name');
        $categoryRange = $request->category_range; // Tên xã
        $priceRange = $request->price_range;
        $areaRange = $request->area;

        // dd([
        //     'province_name' => $provinceName,
        //     'district_name' => $districtName,
        //     'ward_name' => $wardName,
        //     'category_id' => $categoryRange,
        //     'price_range' => $priceRange,
        //     'area_range' => $areaRange,
        // ]);

        // Bắt đầu query
        $query = Post::query();

        $search_keyword = null;
        if ($request->filled('keyword')) {
            $search_keyword = trim($request->keyword);
            $query->where(function ($q) use ($search_keyword) {
                $q->where('title', 'LIKE', "%$search_keyword%")
                    ->orWhere('price', 'LIKE', "%$search_keyword%")
                    ->orWhere('area', 'LIKE', "%$search_keyword%")
                    ->orWhere('province', 'LIKE', "%$search_keyword%")
                    ->orWhere('district', 'LIKE', "%$search_keyword%")
                    ->orWhere('ward', 'LIKE', "%$search_keyword%");
            });
        }

        if ($provinceName) {
            $query->where('province', $provinceName);
        }
        if ($districtName) {
            $query->where('district', $districtName);
        }
        if ($districtName) {
            $query->where('ward', $districtName);
        }
        if ($categoryRange) {
            $query->where('category_id', $categoryRange);
        }

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
    

        // Xử lý khoảng giá
        if ($priceRange !== 'all') {
            switch ($priceRange) {
                case 'under-1m':
                    $query->where('price', '<', 1000000);
                    break;
                case '1-2m':
                    $query->whereBetween('price', [1000000, 2000000]);
                    break;
                case '2-3m':
                    $query->whereBetween('price', [2000000, 3000000]);
                    break;
                case '3-5m':
                    $query->whereBetween('price', [3000000, 5000000]);
                    break;
                case '5-7m':
                    $query->whereBetween('price', [5000000, 7000000]);
                    break;
                case '7-10m':
                    $query->whereBetween('price', [7000000, 10000000]);
                    break;
                case '10-15m':
                    $query->whereBetween('price', [10000000, 15000000]);
                    break;
                case 'over-15m':
                    $query->where('price', '>', 15000000);
                    break;
            }
        }

        // Xử lý khoảng diện tích
        if ($areaRange !== 'all') {
            switch ($areaRange) {
                case 'under-20m':
                    $query->where('area', '<', 20);
                    break;
                case '20-30m':
                    $query->whereBetween('area', [20, 30]);
                    break;
                case '30-50m':
                    $query->whereBetween('area', [30, 50]);
                    break;
                case '50-70m':
                    $query->whereBetween('area', [50, 70]);
                    break;
                case '70-90m':
                    $query->whereBetween('area', [70, 90]);
                    break;
                case 'over-90m':
                    $query->where('area', '>', 90);
                    break;
            }
        }

        $posts = $query->paginate(9);

        return view('front.main.search_results', compact('posts', 'search_keyword'));
    }
}
