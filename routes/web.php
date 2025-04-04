<?php

use App\Http\Controllers\admin\AdminChartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\PosterController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\ApiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\LeaseController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\RenterController;
use Illuminate\Support\Facades\Route;

/// Route Accessable for All

Route::get('/', [UserController::class, 'Index'])->name('index');
Route::get('/logout', [UserController::class, 'UserLogout'])->name('user.logout');
Route::get('/api/proxy/provinces', [ApiController::class, 'getProvinces']);
Route::get('/api/proxy/districts/{provinceId}', [ApiController::class, 'getDistricts']);
Route::get('/api/proxy/wards/{districtId}', [ApiController::class, 'getWards']);

// Route::get('/dashboard', function () {
//   return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/// User group middleware
Route::middleware(['auth', 'roles:user'])->group(function () {
  Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
}); // End User group middleware

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
    Route::post('/update/category/status/{id}', 'UpdateCategoryStatus');
  });
  Route::controller(AdminController::class)->group(function () {
    Route::get('admin/profile', 'AdminProfile')->name('admin.profile');
    Route::post('admin/store/profile', 'AdminStoreUpdateProfile')->name('admin.storeUpdate.profile');
    Route::post('admin/change-password', 'ChangePassword')->name('admin.change.password');
  });
  Route::controller(PostController::class)->group(function () {
    Route::get('admin/all/post/', 'AllPost')->name('admin.all.post');
    Route::get('admin/approved/post', 'approvedPost')->name('admin.approved.post');
    Route::get('admin/pending/post', 'PendingPost')->name('admin.pending.post');
    Route::get('admin/hidden/post', 'HiddenPost')->name('admin.hidden.post');
    Route::get('admin/edit/post/{post_id}/{slug}.html', 'EditPost')->name('admin.edit.post');
    Route::post('admin/store/update/post/{post_id}', 'StoreUpdatePost')->name('admin.store.update.post');
    Route::delete('admin/delete/post/{post_id}', 'DeletePost')->name('admin.delete.post');
    Route::post('admin/update/status-post/{id}', 'UpdateStatusPost');
    // route image post
    Route::get('admin/edit/post-image/{post_id}/{slug}.html', 'EditPostImage')->name('admin.edit.post-image');
    Route::post('admin/upload-image', 'StoreUploadImagePost')->name('admin.update.image.post');
    Route::get('admin/get/post-images', 'GetPostImages')->name('admin.get.post.images');
    Route::post('admin/delete/post-image', 'DeletePostImages')->name('admin.delete.post.image');
    //route video post
    Route::delete('admin/delete-video/{id}',  'deleteVideo');
  });
  Route::controller(RenterController::class)->group(function () {
    Route::get('admin/all/renter', 'AllRenter')->name('admin.all.renter');
    Route::get('admin/edit/renter/{id}', 'EditRenter')->name('admin.edit.renter');
    Route::post('admin/store/renter/{id}', 'StoreRenter')->name('admin.store.renter');
    Route::delete('admin/delete/renter/{id}', 'DeleteRenter')->name('admin.delete.renter');
    Route::post('admin/update/status/renter/{id}', 'UpdateStatusRenter');
  });
  Route::controller(LeaseController::class)->group(function () {
    Route::get('admin/all/lease', 'AllLease')->name('admin.all.lease');
    Route::get('admin/edit/lease/{id}', 'EditLease')->name('admin.edit.lease');
    Route::post('admin/store/lease/{id}', 'StoreLease')->name('admin.store.lease');
    Route::delete('admin/delete/lease/{id}', 'DeleteLease')->name('admin.delete.lease');
    Route::post('admin/update/status/lease/{id}', 'UpdateStatusLease');
  });
  Route::get('/admin/chart/posts', [AdminChartController::class, 'PostChart']);
  Route::get('/admin/chart/user', [AdminChartController::class, 'userStatistics']);
}); // End Admin group middleware


//// Poster group middleware
Route::middleware(['auth', 'roles:poster'])->group(function () {
  Route::get('/poster/dashboard', [PosterController::class, 'PosterDashboard'])->name('poster.dashboard');
  Route::get('/poster/profile', [PosterController::class, 'PosterProfile'])->name('poster.profile');
  Route::get('/poster/post', [PosterController::class, 'PosterPost'])->name('poster.post');
  Route::get('/poster/list-post', [PosterController::class, 'PosterListPost'])->name('poster.list-post');
  Route::get('/poster/change-password', [PosterController::class, 'PosterChangePassword'])->name('poster.change-password');
  Route::post('/poster/store/profile', [PosterController::class, 'PosterStoreProfile'])->name('poster.store.profile');
}); // End Poster group middleware
