<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\PosterController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use Illuminate\Support\Facades\Route;

/// Route Accessable for All

Route::get('/', [UserController::class, 'Index'])->name('index');
Route::get('/logout', [UserController::class, 'UserLogout'])->name('user.logout');

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/// Admin group middleware
Route::middleware(['auth', 'roles:user'])->group(function () {
  Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
}); // End Admin group middleware

/// Admin group middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
  Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
  Route::controller(CategoryController::class)->group(function () {
    Route::get('all/category', "AllCategory")->name('all.category');
  });
}); // End Admin group middleware


//// Poster group middleware
Route::middleware(['auth', 'roles:poster'])->group(function () {
  Route::get('/poster/dashboard', [PosterController::class, 'PosterDashboard'])->name('poster.dashboard');
}); // End Poster group middleware
