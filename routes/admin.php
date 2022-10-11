<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;
//Admin Login
Route::middleware(['admin.login'])->group(function(){
    Route::get('/admin-login',[AdminController::class,'adminLogin'])->name('admin.login');
    Route::post('/admin-login/request',[AdminController::class,'adminLoginRequest'])->name('admin.login.request');
});
Route::middleware(['admin'])->group(function(){
    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');
    Route::post('/admin-logout', [AdminController::class,'logout'])->name('admin.logout');
    //Start Post
    Route::get('/posts',[PostController::class,'index'])->name('post.index');
    Route::get('/add-new-post',[PostController::class,'create'])->name('post.create');
    Route::post('/store-post',[PostController::class,'store'])->name('post.store');
    Route::get('/edit-post/{id}',[PostController::class,'edit'])->name('post.edit');
    Route::post('/update-post/{id}',[PostController::class,'update'])->name('post.update');
    Route::get('/delete-post/{id}',[PostController::class,'destroy'])->name('post.delete');
    Route::post('/update-status-post',[PostController::class,'updateStatus'])->name('post.update.status');
});
