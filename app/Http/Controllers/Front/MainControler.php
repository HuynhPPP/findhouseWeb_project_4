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
use App\Mail\ResetPasswordMail;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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

        $categories = Category::where('status', 'show')
            ->withCount('posts')
            ->get();

        $provinceCounts = Post::selectRaw('province, COUNT(*) as total')
            ->groupBy('province')
            ->pluck('total', 'province');


        return view(
            'front.main.index',
            compact('posts_featured', 'categories', 'posts_newest', 'provinceCounts')
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
        $posts_all_featured = Post::where('is_featured', '1')->paginate(9)->through(function ($post) {
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
        $post = Post::findOrFail($id);

        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $id)
            ->limit(3)
            ->get();

        $post->formatted_price = $this->formatPrice($post->price);

        $images = $post->images;

        return view('front.main.post_detail', compact('post', 'images', 'relatedPosts'));
    }

    public function getPostsByCategory($id)
    {
        $posts_category = Post::where('category_id', $id)->paginate(9)->through(function ($post) {
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

    public function filterByProvince($province)
    {
        // Lọc danh sách bài đăng theo tỉnh/thành phố
        $posts = Post::where('province', $province)->paginate(9);

        // Trả về view hiển thị danh sách bài đăng
        return view('front.main.all_post_province', compact('posts', 'province'));
    }

    public function SearchPost(Request $request)
    {
        $query = Post::query();
        $search_keyword = null;
        $provinceName = $request->input('provinceName');

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

        if (!empty($provinceName)) {
            $query->where('province', $provinceName);
        }

        $posts = $query->paginate(9)->appends($request->all());

        return view('front.main.search_results', compact('posts', 'search_keyword'));
    }

    public function FilterPost(Request $request)
    {
        $provinceName = $request->input('province_name');
        $districtName = $request->input('district_name');
        $wardName = $request->input('ward_name');
        $priceRange = $request->input('price_range', 'all');
        $areaRange = $request->input('area_range', 'all');
        $category = $request->input('category_id', 'all');
        $search_keyword = null;

        // dump([
        //     'province_name' => $provinceName,
        //     'district_name' => $districtName,
        //     'ward_name' => $wardName,
        //     'category_id' => $category,
        //     'price_range' => $priceRange,
        //     'area_range' => $areaRange,
        // ]);

        // Bắt đầu truy vấn
        $query = Post::query();

        // Tìm kiếm theo từ khóa
        if (!empty($search_keyword)) {
            $columns = ['title', 'price', 'area', 'province', 'district', 'ward'];
            $query->where(function ($q) use ($search_keyword, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%$search_keyword%");
                }
            });
        }

        if (!empty($provinceName)) {
            $query->where('province', $provinceName);
        }
        if (!empty($districtName)) {
            $query->where('district', $districtName);
        }
        if (!empty($wardName)) {
            $query->where('ward', $wardName);
        }

        if (!is_null($category) && $category !== '' && $category !== 'all') {
            $query->where('category_id', $category);
        }


        // Lọc theo khoảng giá
        if (!empty($priceRange) && $priceRange !== 'all') {
            $priceConditions = [
                'under-1m' => ['price', '<', 1000000],
                '1-2m' => ['price', '>=', 1000000, '<=', 2000000],
                '2-3m' => ['price', '>=', 2000000, '<=', 3000000],
                '3-5m' => ['price', '>=', 3000000, '<=', 5000000],
                '5-7m' => ['price', '>=', 5000000, '<=', 7000000],
                '7-10m' => ['price', '>=', 7000000, '<=', 10000000],
                '10-15m' => ['price', '>=', 10000000, '<=', 15000000],
                'over-15m' => ['price', '>', 15000000]
            ];

            if (isset($priceConditions[$priceRange])) {
                $condition = $priceConditions[$priceRange];
                if (count($condition) === 3) {
                    $query->where($condition[0], $condition[1], $condition[2]);
                } else {
                    $query->whereBetween($condition[0], [$condition[2], $condition[3]]);
                }
            }
        }

        // Lọc theo diện tích
        if (!empty($areaRange) && $areaRange !== 'all') {
            $areaConditions = [
                'under-20m' => ['area', '<', 20],
                '20-30m' => ['area', '>=', 20, '<=', 30],
                '30-50m' => ['area', '>=', 30, '<=', 50],
                '50-70m' => ['area', '>=', 50, '<=', 70],
                '70-90m' => ['area', '>=', 70, '<=', 90],
                'over-90m' => ['area', '>', 90]
            ];

            if (isset($areaConditions[$areaRange])) {
                $condition = $areaConditions[$areaRange];
                if (count($condition) === 3) {
                    $query->where($condition[0], $condition[1], $condition[2]);
                } else {
                    $query->whereBetween($condition[0], [$condition[2], $condition[3]]);
                }
            }
        }

        // dump($query->toSql(), $query->getBindings());

        $posts = $query->paginate(9);

        return view('front.main.search_results', compact('posts', 'search_keyword'));
    }

    public function ForgetPassword()
    {
        return view('front.main.forget_password_form');
    }

    public function CodePasswordConfirm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email này không tồn tại trong hệ thống.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user->email_verified_at) {
            $notification = [
                'message' => 'Email chưa được xác minh!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $user = User::where('email', $request->email)->first();
        $token = Str::random(6);

        // Lưu token vào bảng password_resets
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now()]
        );

        session(['reset_email' => $request->email]);

        $notification = [
            'message' => 'Mã xác nhận đã được gửi tới email của bạn',
            'alert-type' => 'success',
        ];

        Mail::to($user->email)->send(new ResetPasswordMail($token));

        return redirect('/password/reset/form')->with($notification);
    }

    public function PasswordResetForm()
    {
        return view('front.main.reset_password_form');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu.',
            'password_confirmation.same' => 'Mật khẩu xác nhận không khớp.',
        ]);
        $email = session('reset_email');
        $user = User::where('email', $email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Xóa token sau khi đặt lại mật khẩu thành công
        DB::table('password_reset_tokens')->where('email', $email)->delete();
        session()->forget('reset_email');

        $notification = [
            'message' => 'Mật khẩu đã được đặt lại thành công.',
            'alert-type' => 'success',
        ];

        return redirect()->route('login')->with($notification);
    }

    public function PosterDetail($id)
    {
        $poster = User::find($id);
        $posts = Post::where('user_id',$id)->paginate(4);

        return view('front.main.poster_details',
        compact('poster','posts'));
    }
}
