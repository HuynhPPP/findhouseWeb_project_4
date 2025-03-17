<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\PosterController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\ApiController;
use App\Http\Controllers\Front\MainControler;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use Illuminate\Support\Facades\Route;

/// Route Accessable for All

Route::get('/', [MainControler::class, 'Index'])->name('index');
Route::get('/logout', [UserController::class, 'UserLogout'])->name('user.logout');
Route::post('/user/register', [UserController::class, 'UserRegister'])->name('user.register');
Route::post('/login', [UserController::class, 'UserLogin'])->name('user.login');

Route::get('/api/proxy/provinces', [ApiController::class, 'getProvinces']);
Route::get('/api/proxy/districts/{provinceId}', [ApiController::class, 'getDistricts']);
Route::get('/api/proxy/wards/{districtId}', [ApiController::class, 'getWards']);

Route::get('/all/post/recommend', [MainControler::class, 'AllPostRecommend'])->name('all.post_recommend');
Route::get('/post/details/{id}', [MainControler::class, 'PostDetail'])->name('post.detail');
Route::get('/category/{id}', [MainControler::class, 'getPostsByCategory'])->name('category.posts');
Route::post('/search/post', [MainControler::class, 'SearchPost'])->name('search.post');
Route::post('/filter/post', [MainControler::class, 'FilterPost'])->name('filter.post');

require __DIR__ . '/auth.php';

/// Admin group middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
  Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
  Route::controller(CategoryController::class)->group(function () {
    Route::get('all/category', "AllCategory")->name('admin.all.category');
    Route::delete('delete/category/{category_id}', 'DeleteCategory')->name('admin.delete.category');
    Route::get('create/category', 'CreateCategory')->name('admin.create.category');
    Route::post('store/create/category', 'StoreCreateCategory')->name('admin.storeCreate.category');
    Route::get('edit/category/{category_id}/{slug}.html', 'EditCategory')->name('admin.edit.category');
    Route::post('store/update/category', 'StoreUpdateCategory')->name('admin.storeUpdate.category');
    Route::get('get/category/create', 'FetchCategoryCreate')->name('admin.get.categoryCreate');
    Route::get('get/category/update', 'FetchCategoryUpdate')->name('admin.get.categoryUpdate');
  });
  Route::controller(AdminController::class)->group(function () {
    Route::get('admin/profile', 'AdminProfile')->name('admin.profile');
    Route::post('admin/store/profile', 'AdminStoreUpdateProfile')->name('admin.storeUpdate.profile');
    Route::post('admin/change-password', 'ChangePassword')->name('admin.change.password');
  });
}); // End Admin group middleware


//// Poster group middleware
Route::middleware(['auth', 'roles:poster'])->group(function () {
  Route::get('/poster/dashboard', [PosterController::class, 'PosterDashboard'])->name('poster.dashboard');
  Route::get('/poster/profile', [PosterController::class, 'PosterProfile'])->name('poster.profile');
  Route::post('/poster/store/profile', [PosterController::class, 'PosterStoreProfile'])->name('poster.store.profile');
  Route::get('/poster/post', [PosterController::class, 'PosterPost'])->name('poster.post');
  Route::get('/poster/edit/post/{id}', [PosterController::class, 'PosterEditPost'])->name('poster.edit.post');
  Route::get('/poster/delete/post/{id}', [PosterController::class, 'PosterDeletePost'])->name('poster.delete.post');
  Route::get('/poster/list-post', [PosterController::class, 'PosterListPost'])->name('poster.list-post');
  Route::get('/poster/verification', [PosterController::class, 'PosterVerification'])->name('poster.verification');
  Route::get('/poster/change-password', [PosterController::class, 'PosterChangePassword'])->name('poster.change-password');
  Route::post('/poster/post/store', [PosterController::class, 'PosterPostStore'])->name('poster.post.store');
  Route::post('/poster/post/update', [PosterController::class, 'PosterPostUpdate'])->name('poster.post.update');
  Route::post('/poster/delete/video', [PosterController::class, 'PosterDeleteVideo'])->name('poster.delete.video');
  Route::post('/poster/delete/image', [PosterController::class, 'PosterDeleteImage'])->name('poster.delete.image');
}); // End Poster group middleware

/// User group middleware
Route::middleware(['auth', 'roles:user'])->group(function () {
  Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
  Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
  Route::post('/user/store/profile', [UserController::class, 'UserStoreProfile'])->name('user.store.profile');
}); // End User group middleware
