<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
Route::resource('posts', PostController::class);
##################### Begain Route for posts ########################################
//Route::group(['prefix' => 'posts'], function () {
//
//Route::get('create', [PostController::class,'create']);
//Route::post('store', [PostController::class,'store'])->name('posts.store');
//
//Route::get('all', [PostController::class,'index'])->name('posts.all');
//
//Route::get('edit/{post_id}' , [PostController::class,'edit']);
//Route::post('update/{post_id}', [PostController::class,'update'])->name('posts.update');
//
//Route::get('delete/{post_id}' , [PostController::class,'delete']);
//
////Route::get('likes/{post_id}', 'PostController@getLike') ->middleware('auth');
//
////Route::get('like/{post_id}',  [LikeController::class,'likes']);
//
//Route::get('like/{post_id}',  [PostController::class,'viewLike']);
//});
##################### End Route for posts ########################################



##################### Begain Route for Comments ########################################
Route::group(['prefix' => 'comments'], function () {

Route::get('create/{post_id}', [CommentController::class,'create']);
Route::post('store/{post_id}', [CommentController::class,'store'])->name('comments.store');

Route::get('all/{post_id}', [CommentController::class,'index'])->name('comments.all');

Route::get('edit/{comment_id}', [CommentController::class,'edit']);
Route::post('update/{comment_id}', [CommentController::class,'update'])->name('comments.update');

Route::get('delete/{comment_id}' , [CommentController::class,'delete'])->name('comment.delete');
});

##################### End Route for Comments ########################################



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
