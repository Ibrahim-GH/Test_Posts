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
Route::get('posts/delete/{post}', [PostController::class,'destroy'])->name('posts.delete');
Route::resource('posts', PostController::class);
##################### End Route for posts ########################################

//Route::get('comments/{post}/like', [PostController::class, 'like'])->name('comments.like');
//Route::post('comments/{post_id}', [CommentController::class, 'store'])->name('comments.store');
//Route::resource('comments', CommentController::class)->except(['index','create','show']);

##################### Begain Route for Comments ########################################
Route::group(['prefix' => 'comments'], function () {

//Route::get('create/{post_id}', [CommentController::class,'create']);
Route::post('store/{post}', [CommentController::class,'store'])->name('comments.store');

//Route::get('index/{post_id}', [CommentController::class,'index'])->name('comments.index');

Route::get('edit/{comment_id}', [CommentController::class,'edit']);
Route::get('update/{comment_id}', [CommentController::class,'update'])->name('comments.update');

Route::get('destroy/{comment_id}' , [CommentController::class,'destroy'])->name('comments.destroy');
});

##################### End Route for Comments ########################################


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
