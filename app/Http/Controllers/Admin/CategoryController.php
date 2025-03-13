<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
  public function AllCategory()
  {
    $categories = Category::all();
    return view('admin.category.all_category', compact('categories'), ['title' => 'Tất cả danh mục']);
  }
  public function DeleteCategory($category_id)
  {
    $category = Category::find($category_id);
    if ($category == null) {
      $notification = array(
        'message' => 'Danh mục không tồn tại!',
        'alert-type' => 'error'
      );
      return redirect()->back()->with($notification);
    } else {
      $category->delete();
      $notification = array(
        'message' => 'Xóa danh mục thành công!',
        'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
    }
  }
  public function CreateCategory()
  {
    return view('admin.category.create_category', ['title' => 'Thêm danh mục']);
  }
  public function StoreCreateCategory(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_name' => 'required|max:200|unique:categories,category_name',
      'status' => 'required',
    ], [
      'category_name.required' => 'Vui lòng nhập tên danh mục.',
      'category_name.max' => 'Tên danh mục không được vượt quá 200 ký tự.',
      'category_name.unique' => 'Danh mục đã tồn tại.',
      'status.required' => 'Vui lòng chọn trạng thái.',
    ]);
    if ($validator->passes()) {
      $slugify = new Slugify();
      Category::insert([
        'category_name' => $request->category_name,
        'category_slug' => $slugify->slugify($request->category_name),
        'status' => $request->status,
        'created_at' => Carbon::now(),
      ]);
      session()->flash('toastr', ['success' => 'Thêm danh mục thành công!']);
      return response()->json([
        'status' => true,
        'errors' => [],
      ]);
    } else {
      return response()->json([
        'status' => false,
        'errors' => $validator->errors(),
      ]);
    }
  }
  public function EditCategory($category_id)
  {
    $categories = Category::orderBy('updated_at', 'DESC')->limit(6)->get();
    $category = Category::where('id', $category_id)->first();
    return view('admin.category.edit_category', compact('category', 'categories'), ['title' => 'Cập nhật danh mục']);
  }
  public function StoreUpdateCategory(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_name' => 'required|max:200|unique:categories,id,' . $request->category_id,
      'status' => 'required',
    ], [
      'category_name.required' => 'Vui lòng nhập tên danh mục.',
      'category_name.max' => 'Tên danh mục không được vượt quá 200 ký tự.',
      'category_name.unique' => 'Danh mục đã tồn tại.',
      'status.required' => 'Vui lòng chọn trạng thái.',
    ]);
    if ($validator->passes()) {
      $slugify = new Slugify();
      Category::find($request->category_id)->update([
        'category_name' => $request->category_name,
        'category_slug' => $slugify->slugify($request->category_name),
        'status' => $request->status,
        'updated_at' => Carbon::now()
      ]);
      session()->flash('toastr', ['success' => 'Cập nhật thành công!']);
      return response()->json([
        'status' => true,
        'errors' => [],
      ]);
    } else {
      return response()->json([
        'status' => false,
        'errors' =>  $validator->errors()
      ]);
    }
  }
  public function FetchCategoryCreate()
  {
    $categories = Category::orderBy('created_at', 'DESC')->get();
    return response()->json($categories);
  }
  public function FetchCategoryUpdate()
  {
    $categories = Category::orderBy('updated_at', 'DESC')->get();
    return response()->json($categories);
  }
}
