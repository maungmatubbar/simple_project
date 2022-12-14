<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\ReplyController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('/post-detail/{id}', [PostController::class,'detail'])->name('front.post.detail');
Route::get('/more-post',[HomeController::class,'getMorePost'])->name('front.more.post');
Route::middleware('auth')->group(function(){
    //Comment
    Route::post('/comment',[CommentController::class,'store'])->name('comment.store');
    //Reply
    Route::post('/reply',[ReplyController::class,'store'])->name('reply.store');

});
require __DIR__.'/admin.php';
require __DIR__.'/auth.php';

