<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
      $posts = Post::count();
      $users = User::count();
      $categories = Category::count();
      $images = Image::count();
      $postNew = Post::with(['user', 'firstImage'])
        ->latest('created_at')
        ->limit(5)
        ->get();
      $userNew = User::where('status', 'active')->latest('created_at')->limit(5)->get();
      return view(
        'admin.home',
        compact(
          'posts',
          'users',
          'categories',
          'images',
          'postNew',
          'userNew'
        ),
        ['title' => 'Tổng quan']
      );
    }
}
