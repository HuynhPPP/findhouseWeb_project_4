<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function AllCategory()
  {
    $categories = Category::orderBy('id', 'DESC')->get();
    return view('admin.category.all_category', compact('categories'));
  }
}
