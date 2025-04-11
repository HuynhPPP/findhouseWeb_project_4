<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use Cocur\Slugify\Slugify;
use Embed\Embed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
  public function AllPost()
  {
    $posts = Post::all();
    return view('admin.post.all_post', compact('posts'), ['title' => 'Tất cả tin']);
  }
  public function approvedPost()
  {
    $posts = Post::where('status', 'approved')->get();
    return view('admin.post.approved_post', compact('posts'), ['title' => 'Tin đã duyệt']);
  }
  public function PendingPost()
  {
    $posts = Post::where('status', 'pending')->get();
    return view('admin.post.pending_post', compact('posts'), ['title' => 'Tin chờ duyệt']);
  }
  public function HiddenPost()
  {
    $posts = Post::where('status', 'hidden')->get();
    return view('admin.post.hidden_post', compact('posts'), ['title' => 'Tin đã ẩn']);
  }
  public function EditPost($post_id)
  {
    $post = Post::with(['images'])->findOrFail($post_id);
    $categories = Category::orderBy('id', 'desc')->get();
    return view('admin.post.edit_post', compact('post', 'categories'), ['title' => 'Cập nhật tin']);
  }
  public function UpdateStatusPost(Request $request, $id)
  {
    Post::find($id)->update([
      'status' => $request->status,
    ]);
    return response()->json([
      'status' => true,
      'errors' => [],
    ]);
  }
  public function StoreUpdatePost(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'title'        => 'required|string|max:255',
      'description'  => 'required|string',
      'category_id'  => 'required',
      'price'        => 'required',
      'province'     => 'required',
      'province_name' => 'required',
      'district'     => 'required',
      'district_name' => 'required',
      'ward'         => 'required',
      'area'         => 'required',
      'ward_name'    => 'required',
      'street'       => 'required|string',
      'features'     => 'nullable|array',
      'images'       => 'nullable|array|max:20',
      'images.*'     => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'video_url'    => 'required|url',
      'house_number' => 'required',
      'street' => 'required',
    ], [
      'title.required'       => 'Vui lòng nhập tiêu đề.',
      'description.required' => 'Vui lòng nhập mô tả.',
      'category_id.required' => 'Vui lòng chọn danh mục.',
      'price.required'       => 'Vui lòng nhập giá.',
      'province.required'    => 'Vui lòng chọn tỉnh/thành phố.',
      'district.required'    => 'Vui lòng chọn quận/huyện.',
      'ward.required'        => 'Vui lòng chọn phường/xã.',
      'street.required'        => 'Vui lòng điền tên đường.',
      'house_number.required'        => 'Vui lòng điền số nhà.',
      'ward.area'        => 'Vui lòng nhập diện tích.',
      'images.max'           => 'Bạn chỉ có thể tải lên tối đa 20 ảnh.',
      'video_url.required'       => 'Vui lòng nhập link video.',
      'video_url.url'        => 'Vui lòng nhập URL hợp lệ.',
    ]);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }
    function convertYouTubeUrl($url)
    {
      preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/|.+\?v=)|youtu\.be\/)([^&?]+)/', $url, $matches);
      return !empty($matches[1]) ? "https://www.youtube.com/embed/{$matches[1]}" : null;
    }
    $slugify = new Slugify();
    $post = Post::findOrFail($id);
    // Cập nhật dữ liệu
    $post->update([
      'title' => $request->title,
      'post_slug' => $slugify->slugify($request->title),
      'description' => $request->description,
      'category_id' => $request->category_id,
      'price' => $request->price,
      'province' => $request->province_name,
      'district' => $request->district_name,
      'ward' => $request->ward_name,
      'area' => str_replace(',', '.', $request->area),
      'street' => $request->street,
      'house_number' => $request->house_number,
      'is_featured' => $request->is_featured ? $request->is_featured : '0',
      'is_favorite' => $request->is_favorite ? $request->is_favorite : '0',
      'video_url'  =>  convertYouTubeUrl($request->video_url),
    ]);
    $notification = array(
      'message' => 'Cập nhật thành công!',
      'alert-type' => 'success'
    );
    return redirect()->route('admin.all.post')->with($notification);
  }
  public function DeletePost($post_id)
  {
    $post = Post::findOrFail($post_id);
    if ($post == null) {
      $notification = array(
        'message' => 'Tin đăng không tồn tại!',
        'alert-type' => 'error'
      );
      return redirect()->back()->with($notification);
    } else {
      $post->delete();
      $notification = array(
        'message' => 'Xóa tin đăng thành công!',
        'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
    }
  }
  public function EditPostImage($post_id)
  {
    // dd($post_id);
    $post = Post::findOrFail($post_id);
    if ($post) {
      return view('admin.post.edit_post_image', compact('post'));
    }
  }

  public function StoreUploadImagePost(Request $request)
  {
    $post_id = $request->post_id;
    $path = 'upload/post_images/';
    $files = $request->file('file');
    if ($files && is_array($files)) {
      foreach ($files as $file) {
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = 'post' . $post_id . time() . uniqid() . '.' . $fileExtension;
        $file->move(public_path($path), $fileName);
        $image = new Image();
        $image->post_id = $post_id;
        $image->image_url = $fileName;
        $image->save();
      }
    }
  }
  public function GetPostImages(Request $request)
  {
    $post = Post::with('images')->findOrFail($request->post_id);
    $path = 'upload/post_images/';
    $html = '';
    if ($post->images->count() > 0) {
      foreach ($post->images as $item) {
        $html .= '<div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <div class="image-container">
                  <img
                    src="/' . $path . $item->image_url . '"
                    class="card-img-top" alt="post_image">
                  <button id="deletePostImageBtn" class="delete-btn" data-image="' . $item->id . '" ><i
                      class="fa fa-trash"></i></button>
                </div>
              </div>
             ';
      }
    }
    return response()->json(['status' => 1, 'data' => $html]);
  }
  public function DeletePostImages(Request $request)
  {
    $post_image = Image::findOrFail($request->image_id);
    $path = 'upload/post_images/';
    if ($post_image->image_url != null && File::exists(public_path($path . $post_image->image_url))) {
      File::delete(public_path($path . $post_image->image_url));
    }
    $delete = $post_image->delete();
    if ($delete) {
      return response()->json(['status' => 1, 'msg' => 'Xóa ảnh thành công!']);
    } else {
      return response()->json(['status' => 0, 'msg' => 'Đã xảy ra lỗi!']);
    }
  }
  public function deleteVideo($id)
  {
    $post = Post::find($id);
    if (!$post) {
      return response()->json(['success' => false, 'message' => 'Bài viết không tồn tại'], 404);
    }
    // Cập nhật video_url về null hoặc xóa video nếu cần
    $post->video_url = null;
    $post->save();
    return response()->json(['success' => true, 'message' => 'Video đã được xóa']);
  }
}
