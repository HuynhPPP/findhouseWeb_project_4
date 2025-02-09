<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function AllPost()
  {
    $posts = Post::all();
    return view('admin.post.all_post', compact('posts'), ['title' => 'Tất cả tin']);
  }
  public function EditPost($post_id)
  {
    $post = Post::find($post_id);
    $categories = Category::orderBy('id', 'desc')->get();
    return view('admin.post.edit_post', compact('post', 'categories'), ['title' => 'Cập nhật tin']);
  }
  public function StoreUpdatePost(Request $request)
  {
    dd($request->all());
  }
}
