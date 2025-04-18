<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;
use App\Models\Image;
use App\Models\Category;
use App\Mail\ResetPasswordMail;
use App\Mail\EmailVerificationMail;
use Cocur\Slugify\Slugify;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;


class PosterController extends Controller
{
    public function PosterDashboard()
    {
        $id = Auth::user()->id;

        return view('front.poster.index');
    }

    public function PosterProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('front.poster.poster_profile_view', compact('profileData'));
    }

    public function PosterStoreProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $data->photo));
            $filename = 'poster_' . $id . '_' . date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Cập nhật thành công',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function PosterPost()
    {
        return view('front.poster.post.poster_post_view');
    }

    public function PosterListPost(Request $request)
    {
        $id = Auth::user()->id;
        $list_post = Post::where('user_id', $id)
            ->with('images')
            ->orderBy('id', 'desc')
            ->paginate(4);


        return view('front.poster.post.poster_list_post_view', compact('list_post',));
    }

    public function PosterChangePassword()
    {
        return view('front.poster.poster_change_password');
    }

    public function PosterVerification()
    {
        return view('front.poster.poster_verification');
    }

    private function convertVideoUrl($url)
    {
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return "https://www.youtube.com/embed/" . $matches[1];
        }

        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return "https://www.youtube.com/embed/" . $matches[1];
        }

        // Nếu là TikTok hoặc không phù hợp, trả về URL gốc
        return $url;
    }

    public function PosterPostStore(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'category_id'  => 'required',
            'price'        => 'required|numeric|min:0',
            'area'         => 'required|numeric|min:0',
            'province'     => 'required',
            'province_name' => 'required',
            'district'     => 'required',
            'district_name' => 'required',
            'ward'         => 'required',
            'ward_name'    => 'required',
            'street'       => 'required|string',
            'house_number' => 'required|string',
            'address'      => 'required|string',
            'images'       => 'nullable|array|max:20',
            'images.*'     => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url'    => 'nullable|string',
        ], [
            'title.required'       => 'Vui lòng nhập tiêu đề.',
            'title.max'            => 'Tiêu đề không được vượt quá 255 ký tự.',
            'description.required' => 'Vui lòng nhập mô tả.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'price.required'       => 'Vui lòng nhập giá.',
            'price.numeric'        => 'Giá phải là số.',
            'price.min'            => 'Giá không được nhỏ hơn 0.',
            'area.required'        => 'Vui lòng nhập diện tích.',
            'area.numeric'         => 'Diện tích phải là số.',
            'area.min'             => 'Diện tích không được nhỏ hơn 0.',
            'province.required'    => 'Vui lòng chọn tỉnh/thành phố.',
            'province_name.required' => 'Tên tỉnh/thành phố không được để trống.',
            'district.required'    => 'Vui lòng chọn quận/huyện.',
            'district_name.required' => 'Tên quận/huyện không được để trống.',
            'ward.required'        => 'Vui lòng chọn phường/xã.',
            'ward_name.required'   => 'Tên phường/xã không được để trống.',
            'street.required'      => 'Vui lòng nhập tên đường.',
            'house_number.required' => 'Vui lòng nhập số nhà.',
            'address.required'     => 'Vui lòng nhập địa chỉ.',
            'images.max'           => 'Bạn chỉ có thể tải lên tối đa 20 ảnh.',
            'images.*.image'       => 'File tải lên phải là hình ảnh.',
            'images.*.mimes'       => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
            'images.*.max'         => 'Hình ảnh không được vượt quá 2MB.',
            'video_url.url'        => 'Link video không hợp lệ.',
            'video_url.regex'      => 'Link video chỉ hỗ trợ YouTube',
        ]);

        $videoUrl = $request->video_url ? $this->convertVideoUrl($request->video_url) : null;

        $slugify = new Slugify();

        $post = new Post();
        $post->user_id       = Auth::id();
        $post->category_id   = $request->category_id;
        $post->title         = $request->title;
        $post->post_slug     = $slugify->slugify($request->title);
        $post->description   = $request->description;
        $post->price         = $request->price;
        $post->area          = $request->area;
        $post->province      = $request->province_name;
        $post->district      = $request->district_name;
        $post->ward          = $request->ward_name;
        $post->street        = $request->street;
        $post->house_number  = $request->house_number;
        $post->video_url     = $videoUrl;
        $post->status        = 'pending';
        $post->created_at    = now();

        $post->save();


        $imageDir = public_path('upload/post_images');

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $username = Auth::user()->name ?? 'poster'; // hoặc fullname nếu bạn dùng
                $timestamp = now()->format('Ymd_His');
                $uniqueId = uniqid();
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$username}_{$timestamp}_{$uniqueId}.{$extension}";

                $image->move($imageDir, $imageName);

                Image::create([
                    'post_id'    => $post->id,
                    'image_url'  => $imageName,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $notification = array(
            'message' => 'Đăng tin thành công !',
            'alert-type' => 'success',
        );

        return redirect()->route('poster.list-post')->with($notification);
    }

    public function PosterPostUpdate(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'category_id'  => 'required',
            'price'        => 'required|numeric|min:0',
            'area'         => 'required|numeric|min:0',
            'province'     => 'required',
            'province_name' => 'required',
            'district'     => 'required',
            'district_name' => 'required',
            'ward'         => 'required',
            'ward_name'    => 'required',
            'street'       => 'required|string',
            'house_number' => 'required|string',
            'address'      => 'required|string',
            'images'       => 'nullable|array|max:20',
            'images.*'     => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url'    => 'nullable|string', // Validate URL cho YouTube/TikTok
        ], [
            'title.required'       => 'Vui lòng nhập tiêu đề.',
            'title.max'            => 'Tiêu đề không được vượt quá 255 ký tự.',
            'description.required' => 'Vui lòng nhập mô tả.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'price.required'       => 'Vui lòng nhập giá.',
            'price.numeric'        => 'Giá phải là số.',
            'price.min'            => 'Giá không được nhỏ hơn 0.',
            'area.required'        => 'Vui lòng nhập diện tích.',
            'area.numeric'         => 'Diện tích phải là số.',
            'area.min'             => 'Diện tích không được nhỏ hơn 0.',
            'province.required'    => 'Vui lòng chọn tỉnh/thành phố.',
            'province_name.required' => 'Tên tỉnh/thành phố không được để trống.',
            'district.required'    => 'Vui lòng chọn quận/huyện.',
            'district_name.required' => 'Tên quận/huyện không được để trống.',
            'ward.required'        => 'Vui lòng chọn phường/xã.',
            'ward_name.required'   => 'Tên phường/xã không được để trống.',
            'street.required'      => 'Vui lòng nhập tên đường.',
            'house_number.required' => 'Vui lòng nhập số nhà.',
            'address.required'     => 'Vui lòng nhập địa chỉ.',
            'images.max'           => 'Bạn chỉ có thể tải lên tối đa 20 ảnh.',
            'images.*.image'       => 'File tải lên phải là hình ảnh.',
            'images.*.mimes'       => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
            'images.*.max'         => 'Hình ảnh không được vượt quá 2MB.',
            'video_url.url'        => 'Link video không hợp lệ.',
            'video_url.regex'      => 'Link video chỉ hỗ trợ YouTube',
        ]);

        $post_id = $request->id;
        $poster_name = $request->poster_name;

        $slugify = new Slugify();

        $videoUrl = $request->video_url ? $this->convertVideoUrl($request->video_url) : null;


        Post::find($post_id)->update([
            'user_id' => Auth::id(),
            'category_id'  => $request->category_id,
            'title'        => $request->title,
            'post_slug'    => $slugify->slugify($request->title),
            'description'  => $request->description,
            'price'        => $request->price,
            'area'         => $request->area,
            'province'     => $request->province_name,
            'district'     => $request->district_name,
            'ward'         => $request->ward_name,
            'street'       => $request->street,
            'house_number' => $request->house_number,
            'video_url'     => $videoUrl,
            'updated_at'   => now(),
        ]);

        $imageDir = public_path('upload/post_images');

        if ($request->hasFile('images')) {
            // Lưu ảnh mới
            foreach ($request->file('images') as $image) {
                $username = $poster_name ?? 'poster';
                $timestamp = now()->format('Ymd_His');
                $uniqueId = uniqid();
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$username}_{$timestamp}_{$uniqueId}.{$extension}";

                $image->move($imageDir, $imageName);

                Image::create([
                    'post_id'    => $post_id,
                    'image_url'  => $imageName,
                    'created_at' => Carbon::now(),
                ]);
            }
        }


        // Thông báo cập nhật thành công
        $notification = [
            'message' => 'Cập nhật bài đăng thành công!',
            'alert-type' => 'success',
        ];

        return redirect()->route('poster.list-post')->with($notification);
    }

    public function PosterEditPost($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::latest()->get();
        $images = Image::where('post_id', $id)->get();

        $selectedFeatures = json_decode($post->features, true) ?? [];


        return view(
            'front.poster.post.poster_post_edit',
            compact('post', 'categories', 'images', 'selectedFeatures')
        );
    }

    public function PosterDeleteImage(Request $request)
    {
        $image = Image::find($request->id);

        if (!$image) {
            return response()->json(['error' => true, 'message' => 'Ảnh không tồn tại!']);
        }

        $imagePath = public_path('upload/post_images/' . $image->image_url);

        if (file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                return response()->json(['error' => true, 'message' => 'Không thể xóa ảnh!']);
            }
        }

        $image->delete();

        return response()->json(['success' => true]);
    }


    public function PosterDeletePost($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with([
                'message' => 'Bài đăng không tồn tại!',
                'alert-type' => 'error'
            ]);
        }

        $images = Image::where('post_id', $post->id)->get();
        foreach ($images as $image) {
            $imagePath = public_path($image->image_url); // Đường dẫn ảnh
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $image->delete();
        }

        $post->delete();

        return redirect()->route('poster.list-post')->with([
            'message' => 'Bài đăng đã được xoá!',
            'alert-type' => 'success'
        ]);
    }

    public function ChangePassword(Request $request)
    {
        $messages = [
            'oldPassword.required' => 'Vui lòng nhập mật khẩu cũ.',
            'newPassword.required' => 'Vui lòng nhập mật khẩu mới.',
            'newPassword.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'newPassword.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ];

        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|confirmed',
        ], $messages);

        if (empty($request->oldPassword) && empty($request->newPassword) && empty($request->newPassword_confirmation)) {
            return response()->json(['errors' => ['Vui lòng nhập đầy đủ thông tin.']], 422);
        }

        // Kiểm tra lỗi validate
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $id = Auth::user()->id;
        $user = User::find($id);

        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->oldPassword, $user->password)) {
            return response()->json(['errors' => ['oldPassword' => ['Mật khẩu cũ không đúng.']]], 422);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json([
            'success' => 'Mật khẩu đã được cập nhật thành công.',
            'alert-type' => 'success'
        ]);
    }

    public function ForgetPassword()
    {
        return view('front.poster.poster_forget_password');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email này chưa được đăng ký trong hệ thống.'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user->email_verified_at) {
            $notification = [
                'message' => 'Email chưa được xác minh!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        // Tạo mã xác nhận ngẫu nhiên
        $token = Str::random(6);

        // Lưu token vào database với thời gian hết hạn
        DB::table(' password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        $notification = [
            'message' => 'Mã xác nhận đã được gửi tới email của bạn',
            'alert-type' => 'success',
        ];

        // Gửi email
        Mail::to($user->email)->send(new ResetPasswordMail($token));

        return redirect('/poster/confirm/password/code')->with($notification);
    }

    public function showConfirmCodeForm()
    {
        return view('front.poster.emails.form_confirm_password_code');
    }

    public function verifyResetCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string',
        ], [
            'verification_code.required' => 'Vui lòng nhập mã xác minh.',
        ]);

        $resetEntry = DB::table('password_reset_tokens')
            ->where('token', $request->verification_code)
            ->first();

        if (!$resetEntry) {
            return redirect()->back()->withErrors([
                'verification_code' => 'Mã xác minh không hợp lệ hoặc đã hết hạn!',
            ]);
        }

        // Chuyển hướng đến form đặt lại mật khẩu, truyền email và token
        return view('front.poster.emails.reset_password_form', [
            'email' => $resetEntry->email,
            'token' => $request->verification_code
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        $resetEntry = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetEntry) {
            return redirect()->back()->withErrors([
                'token' => 'Mã xác nhận không hợp lệ hoặc đã hết hạn!',
            ]);
        }

        // Cập nhật mật khẩu mới
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Xóa token sau khi đặt lại mật khẩu thành công
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/login')->with([
            'message' => 'Mật khẩu đã được đặt lại thành công!',
            'alert-type' => 'success',
        ]);
    }

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->email_verified_at) {
            $notification = [
                'message' => 'Email đã được xác minh trước đó',
                'alert-type' => 'info',
            ];

            return redirect()->back()->with($notification);
        }

        // Tạo mã xác minh 6 chữ số
        $verificationCode = rand(100000, 999999);
        $user->verification_token = $verificationCode;
        $user->save();

        // Gửi email xác minh
        Mail::to($user->email)->send(new EmailVerificationMail($user));

        $notification = [
            'message' => 'Mã xác minh đã được gửi đến email của bạn',
            'alert-type' => 'success',
        ];

        return redirect('/poster/verification/email/code')->with($notification);
    }

    public function VerificationWithEmailCode()
    {
        return view('front.poster.emails.verify_email_code');
    }

    public function verifyEmailCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|digits:6'
        ], [
            'verification_code.required' => 'Vui lòng nhập mã xác minh.',
            'verification_code.digits'   => 'Mã xác minh phải là 6 chữ số.'
        ]);

        // Tìm user theo mã xác minh
        $user = User::where('verification_token', $request->verification_code)->first();

        if (!$user) {
            $notification = [
                'message' => 'Mã xác minh không hợp lệ',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        // Cập nhật trường email_verified_at và xóa mã xác minh
        $user->email_verified_at = Carbon::now();
        $user->verification_token = null;
        $user->save();


        $notification = [
            'message' => 'Email đã được xác minh thành công',
            'alert-type' => 'success',
        ];

        return redirect('/poster/verification')->with($notification);
    }

    public function PosterContacts()
    {
        return view('front.poster.poster_contacts');
    }
}
