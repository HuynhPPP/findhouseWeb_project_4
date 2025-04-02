<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\PosterController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\ApiController;
use App\Http\Controllers\Front\MainControler;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\ChatController;
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
Route::get('/properties/{province}', [MainControler::class, 'filterByProvince'])->name('properties.by.province');
Route::post('/search/post', [MainControler::class, 'SearchPost'])->name('search.post');
Route::post('/filter/post', [MainControler::class, 'FilterPost'])->name('filter.post');

Route::get('/forget/password', [MainControler::class, 'ForgetPassword'])->name('forget.password');
Route::post('/confirm/password/code', [MainControler::class, 'CodePasswordConfirm'])->name('confirm.password.code');
Route::get('/password/reset/form', [MainControler::class, 'PasswordResetForm'])->name('password.reset.form');
Route::post('/reset/password', [MainControler::class, 'ResetPassword'])->name('reset.password');

Route::post('/send-message', [ChatController::class, 'SendMessage']);
Route::get('/user-all', [ChatController::class, 'GetAllUsers']);
Route::get('/user-message/{id}', [ChatController::class, 'UserMsgById']);
Route::get('/messages-of-group/{postId}', [ChatController::class, 'getMessagesByPostId']);

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
  Route::get('/poster/post', [PosterController::class, 'PosterPost'])->name('poster.post')->middleware('email.verified');
  Route::get('/poster/edit/post/{id}', [PosterController::class, 'PosterEditPost'])->name('poster.edit.post');
  Route::get('/poster/delete/post/{id}', [PosterController::class, 'PosterDeletePost'])->name('poster.delete.post');
  Route::get('/poster/list-post', [PosterController::class, 'PosterListPost'])->name('poster.list-post');
  Route::get('/poster/change-password', [PosterController::class, 'PosterChangePassword'])->name('poster.change-password');
  Route::post('/poster/post/store', [PosterController::class, 'PosterPostStore'])->name('poster.post.store');
  Route::post('/poster/post/update', [PosterController::class, 'PosterPostUpdate'])->name('poster.post.update');
  Route::post('/poster/delete/video', [PosterController::class, 'PosterDeleteVideo'])->name('poster.delete.video');
  Route::post('/poster/delete/image', [PosterController::class, 'PosterDeleteImage'])->name('poster.delete.image');
  Route::post('/poster/change-password', [PosterController::class, 'ChangePassword'])->name('poster.change.password');

  // forget password
  Route::get('/poster/forget-password', [PosterController::class, 'ForgetPassword'])->name('poster.forget.password');
  Route::post('/password/password/code', [PosterController::class, 'sendResetCode'])->name('password.password.code');
  Route::get('/poster/confirm/password/code', [PosterController::class, 'showConfirmCodeForm'])->name('poster.confirm.password.code');
  Route::post('/poster/verify/password/code', [PosterController::class, 'verifyResetCode'])->name('poster.verify.password.code');
  Route::post('/poster/reset/password', [PosterController::class, 'resetPassword'])->name('poster.reset.password');


  // verification mail
  Route::get('/poster/verification', [PosterController::class, 'PosterVerification'])->name('poster.verification');
  Route::post('/email/verify', [PosterController::class, 'sendVerificationCode'])->name('email.verify');
  Route::get('/poster/verification/email/code', [PosterController::class, 'VerificationWithEmailCode'])->name('password.verification.email.code');
  Route::post('/email/verify-code', [PosterController::class, 'verifyEmailCode'])->name('email.verify.code');

  // Contacts
  Route::get('/poster/contacts', [PosterController::class, 'PosterContacts'])->name('poster.contacts');
}); // End Poster group middleware

/// User group middleware
Route::middleware(['auth', 'roles:user'])->group(function () {
  Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
  Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
  Route::get('/user/contacts', [UserController::class, 'UserContacts'])->name('user.contacts');
  Route::post('/user/store/profile', [UserController::class, 'UserStoreProfile'])->name('user.store.profile');
  Route::post('/bookings/store', [ContactController::class, 'BookingStore'])->name('bookings.store');
  Route::post('/bookings/cancel/{id}', [ContactController::class, 'CancelBooking'])->name('bookings.cancel');

  Route::get('/user/change-password', [UserController::class, 'UserChangePassword'])->name('user.change-password');
  Route::post('/user/reset/password', [UserController::class, 'ChangePassword'])->name('user.reset.password');

}); // End User group middleware
