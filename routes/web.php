<?php

use App\Http\Controllers\admin\AdminChartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Front\PosterController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\ApiController;
use App\Http\Controllers\Front\MainControler;
use App\Http\Controllers\Front\ChatController;
use App\Http\Controllers\Front\SocialliteController;
use App\Http\Controllers\Front\SavedPostController;
use App\Http\Controllers\Front\ReviewController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\LeaseController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\RenterController;
use App\Http\Controllers\admin\SettingController;
use Illuminate\Support\Facades\Route;

/// Route Accessable for All

Route::get('/', [MainControler::class, 'Index'])->name('index');
Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
Route::post('/user/register', [UserController::class, 'UserRegister'])->name('user.register');
Route::post('/user/login', [UserController::class, 'UserLogin'])->name('user.login');

Route::get('/user/login/page', [UserController::class, 'UserLoginPage'])->name('user.login.page');
Route::get('/user/register/page', [UserController::class, 'UserRegisterPage'])->name('user.register.page');

Route::get('/api/proxy/provinces', [ApiController::class, 'getProvinces']);
Route::get('/api/proxy/districts/{provinceId}', [ApiController::class, 'getDistricts']);
Route::get('/api/proxy/wards/{districtId}', [ApiController::class, 'getWards']);

Route::get('/all/post/recommend', [MainControler::class, 'AllPostRecommend'])->name('all.post_recommend');
Route::get('/post/details/{id}/{post_slug}', [MainControler::class, 'PostDetail'])->name('post.detail');
Route::get('/category/{id}', [MainControler::class, 'getPostsByCategory'])->name('category.posts');
Route::get('/properties/{province}', [MainControler::class, 'filterByProvince'])->name('properties.by.province');
Route::match(['get', 'post'], '/search/post', [MainControler::class, 'SearchPost'])->name('search.post');
Route::post('/filter/post', [MainControler::class, 'FilterPost'])->name('filter.post');

Route::get('/forget/password', [MainControler::class, 'ForgetPassword'])->name('forget.password');
Route::post('/confirm/password/code', [MainControler::class, 'sendResetCodeEmail'])->name('confirm.password.code');
Route::get('/password/verify/code/form', [MainControler::class, 'FormVerifyCode'])->name('form.verify.code');
Route::post('/password/verify/code', [MainControler::class, 'verifyResetCode'])->name('password.verify.code');
Route::get('/password/reset/form', [MainControler::class, 'PasswordResetForm'])->name('password.reset.form');
Route::post('/reset/password', [MainControler::class, 'ResetPassword'])->name('reset.password');
Route::get('/poster-detail/{id}', [MainControler::class, 'PosterDetail'])->name('poster.detail');

Route::post('/send-message', [ChatController::class, 'SendMessage']);
Route::get('/user-all', [ChatController::class, 'GetAllUsers']);
Route::get('/user-message/{id}', [ChatController::class, 'UserMsgById']);
Route::get('/messages-of-group/{postId}', [ChatController::class, 'getMessagesByPostId']);

Route::controller(SocialliteController::class)->group(function () {
  Route::get('/login-with-goole', 'AuthGoogle')->name('auth.google');
  Route::get('/auth/google/call-back', 'GoogleAuthentication')->name('auth.google.callback');
});

Route::controller(SavedPostController::class)->group(function () {
  Route::post('/add-to-wishlist/{post_id}', 'AddToWishlist');
});

Route::post('/store/review', [ReviewController::class, 'StoreReview'])->name('store.review');
Route::get('/posts/search/sort', [MainControler::class, 'sortSearchPosts'])->name('posts.search.sort');
Route::get('/posts/recommend/sort', [MainControler::class, 'sortRecommendPosts'])->name('posts.recommend.sort');
Route::get('/posts/category/sort/{id}', [MainControler::class, 'sortPostsByCategory'])->name('posts.category.sort');
Route::get('/posts/province/{province}/sort', [MainControler::class, 'sortPostsByProvince'])->name('posts.province.sort');

Route::get('/user-online-status/{id}', [UserController::class, 'GetUserStatus']);
Route::get('/load-reviews', [ReviewController::class, 'loadReviews'])->name('load.reviews');



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
  Route::controller(SettingController::class)->group(function () {
    Route::get('admin/smtp/setting', 'SmtpSetting')->name('smtp.setting');
    Route::post('update/smtp', 'UpdateSmtp')->name('update.smtp');
    Route::get('admin/site/setting', 'SiteSetting')->name('site.setting');
    Route::post('update/site/setting', 'UpdateSiteSetting')->name('update.site.setting');
  });
  Route::post('/mark-notification-as-read/{notification}', [PosterController::class, 'MarkAsRead']);
}); // End Admin group middleware

//// Poster group middleware
Route::middleware(['auth', 'roles:poster'])->group(function () {
  Route::get('/poster/dashboard', [PosterController::class, 'PosterDashboard'])->name('poster.dashboard');
  Route::get('/poster/profile', [PosterController::class, 'PosterProfile'])->name('poster.profile');
  Route::post('/poster/store/profile', [PosterController::class, 'PosterStoreProfile'])->name('poster.store.profile');
  Route::get('/poster/post', [PosterController::class, 'PosterPost'])->name('poster.post')->middleware('email.verified');
  Route::get('/poster/edit/post/{id}/{post_slug}', [PosterController::class, 'PosterEditPost'])->name('poster.edit.post');
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

  // Saved Post
  Route::get('/poster/list-SavedPost', [SavedPostController::class, 'PosterListSavedPost'])->name('poster.list.SavedPost');
  Route::get('/poster/remove-saved-post/{id}', [SavedPostController::class, 'removeSavedPostPoster'])->name('poster.removeSavedPost');

  // Review Post
  Route::get('/poster/review', [ReviewController::class, 'PosterReview'])->name('poster.review');
  Route::get('/poster/delete/review/{id}', [ReviewController::class, 'PosterDeleteReview'])->name('poster.delete.review');
  Route::post('/review/toggle-status/{id}', [ReviewController::class, 'PosterToggleReview'])->name('review.toggle.status');
  Route::get('/reviews/sort', [ReviewController::class, 'PosterReviewSort'])->name('reviews.list.sort');
}); // End Poster group middleware

/// User group middleware
Route::middleware(['auth', 'roles:user'])->group(function () {
  Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
  Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
  Route::get('/user/contacts', [UserController::class, 'UserContacts'])->name('user.contacts');
  Route::post('/user/store/profile', [UserController::class, 'UserStoreProfile'])->name('user.store.profile');

  Route::get('/user/change-password', [UserController::class, 'UserChangePassword'])->name('user.change-password');
  Route::post('/user/reset/password', [UserController::class, 'ChangePassword'])->name('user.reset.password');

  Route::get('/user/list-SavedPost', [SavedPostController::class, 'UserListSavedPost'])->name('user.list.SavedPost');
  Route::get('/user/remove-saved-post/{id}', [SavedPostController::class, 'removeSavedPost'])->name('user.removeSavedPost');

  // verification mail
  Route::get('/user/verification', [UserController::class, 'UserVerification'])->name('user.verification');
  Route::post('/user/email/verify', [UserController::class, 'sendVerificationCode'])->name('user.email.verify');
  Route::get('/user/verification/email/code', [UserController::class, 'VerificationWithEmailCode'])->name('user.password.verification.email.code');
  Route::post('/user/email/verify-code', [UserController::class, 'verifyEmailCode'])->name('user.email.verify.code');
}); // End User group middleware
