<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;
use App\Models\Image;
use App\Models\Video;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    public function PosterDashboard()
    {
        return view('front.poster.index');
    }

    public function PosterProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('front.poster.poster_profile_view',compact('profileData'));
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
            @unlink(public_path('front/upload/poster_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('front/upload/poster_images'),$filename);
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

    public function PosterListPost()
    {
        $id = Auth::user()->id;
        $list_post = Post::where('user_id', $id)
                ->with('images') 
                ->orderBy('id', 'desc')
                ->get();


        return view('front.poster.post.poster_list_post_view',compact('list_post',));
    }

    public function PosterChangePassword()
    {
        return view('front.poster.poster_change_password');
    }

    public function PosterVerification()
    {
        return view('front.poster.poster_verification');
    }

    public function PosterPostStore(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required',
            'price'       => 'required',
            'address'     => 'required',
            'province' => 'required',
            'province_name' => 'required',
            'district' => 'required',
            'district_name' => 'required',
            'ward' => 'required',
            'ward_name' => 'required',
            'street'      => 'required|string',
            'house_number'=> 'required|string',
            'features'    => 'nullable|array',
            'images'      => 'nullable|array|max:20',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video'       => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
        ], [
            'title.required'       => 'Vui lòng nhập tiêu đề.',
            'description.required' => 'Vui lòng nhập mô tả.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'price.required'       => 'Vui lòng nhập giá.',
            'address.required'     => 'Vui lòng nhập địa chỉ.',
            'province.required'    => 'Vui lòng chọn tỉnh/thành phố.',
            'district.required'    => 'Vui lòng chọn quận/huyện.',
            'ward.required'        => 'Vui lòng chọn phường/xã.',
            'street.required'      => 'Vui lòng nhập tên đường.',
            'house_number.required'=> 'Vui lòng nhập số nhà.',
            'images.max'           => 'Bạn chỉ có thể tải lên tối đa 20 ảnh.',
            'video.mimes'          => 'Chỉ chấp nhận định dạng MP4, MOV, AVI, WMV.',
            'video.max'            => 'Video không được vượt quá 10MB.',
        ]);
        

        $features = $request->filled('features') ? json_encode($request->features, JSON_UNESCAPED_UNICODE) : null;
        

        $post = new Post();
        $post->user_id       = Auth::id();
        $post->category_id   = $request->category_id;
        $post->title         = $request->title;
        $post->post_slug     = strtolower(str_replace(' ', '-', $request->title));
        $post->description   = $request->description;
        $post->price         = $request->price;
        $post->area          = $request->area;
        $post->address       = $request->address;
        $post->province      = $request->province_name;
        $post->district      = $request->district_name;
        $post->ward          = $request->ward_name;
        $post->street        = $request->street;
        $post->house_number  = $request->house_number;
        $post->name_poster   = $request->name_poster;
        $post->email_poster  = $request->email_poster;
        $post->phone_poster  = $request->phone_poster;
        $post->features      = $features;
        $post->status        = 'pending';
        $post->created_at    = now();
        $post->save();


         // Đường dẫn thư mục lưu ảnh & video
        $imageDir = public_path('front/upload/post_images');
        $videoDir = public_path('front/upload/post_video');

        // Upload images (tối đa 20 ảnh)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move($imageDir, $imageName); 
    
                Image::create([
                    'post_id'    => $post->id,
                    'image_name' => $image->getClientOriginalName(),
                    'image_url'  => 'front/upload/post_images/'.$imageName, 
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        // Upload video (chỉ cho phép 1 video)
        if ($request->hasFile('videos')) {
            $video = $request->file('videos');
            $videoName = time().'_'.$video->getClientOriginalName();
            $video->move($videoDir, $videoName); 
    
            Video::create([
                'post_id'    => $post->id,
                'video_url'  => 'front/upload/post_video/'.$videoName,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Đăng tin thành công !',
            'alert-type' => 'success',
        );

        return redirect()->route('poster.list-post')->with($notification);
    }
}
