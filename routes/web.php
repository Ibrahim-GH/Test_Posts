<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

##################### Begain Route for posts ########################################
Route::get('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
Route::resource('posts', PostController::class);
##################### End Route for posts ########################################

//Route::get('comments/{post}/like', [PostController::class, 'like'])->name('comments.like');
//Route::post('comments/{post_id}', [CommentController::class, 'store'])->name('comments.store');
Route::resource('comments', CommentController::class)->except(['index','create','show']);

##################### Begain Route for Comments ########################################
//Route::group(['prefix' => 'comments'], function () {
//
//Route::get('create/{post_id}', [CommentController::class,'create']);
//Route::post('store/{post_id}', [CommentController::class,'store'])->name('comments.store');
//
//Route::get('all/{post_id}', [CommentController::class,'index'])->name('comments.all');
//
//Route::get('edit/{comment_id}', [CommentController::class,'edit']);
//Route::post('update/{comment_id}', [CommentController::class,'update'])->name('comments.update');
//
//Route::get('delete/{comment_id}' , [CommentController::class,'delete'])->name('comment.delete');
//});

##################### End Route for Comments ########################################


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
