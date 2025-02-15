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
        return view('front.poster.post.poster_list_post_view');
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
            // 'name_poster' => 'required|string',
            // 'email_poster'=> 'required|email',
            // 'phone_poster'=> 'required|numeric',
            'features'    => 'nullable|array',
            // 'images.*'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'videos.*'    => 'mimes:mp4,mov,avi,wmv|max:10240'
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

        // dd($post);
        $post->save();


        


        // Upload images
        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $image) {
        //         $imagePath = $image->store('uploads/images', 'public');
        //         Image::create([
        //             'post_id'   => $post->id,
        //             'image_name'=> $image->getClientOriginalName(),
        //             'image_url' => $imagePath
        //         ]);
        //     }
        // }

        // Upload videos
        // if ($request->hasFile('videos')) {
        //     foreach ($request->file('videos') as $video) {
        //         $videoPath = $video->store('uploads/videos', 'public');
        //         Video::create([
        //             'post_id'   => $post->id,
        //             'video_url' => $videoPath
        //         ]);
        //     }
        // }

        $notification = array(
            'message' => 'Đăng tin thành công !',
            'alert-type' => 'success',
        );

        return redirect()->route('poster.list-post')->with($notification);
    }
}
