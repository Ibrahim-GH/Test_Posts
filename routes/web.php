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

// route for multi language
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    //route for posts
    Route::get('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
//    Route::get('posts/delete/{post}', [PostController::class, 'destroy'])->name('posts.delete');
    Route::resource('posts', PostController::class);


    //route for comments
    Route::group(['prefix' => 'comments'], function () {

        Route::post('store/{post}', [CommentController::class, 'store'])->name('comments.store');

        Route::get('edit/{comment_id}', [CommentController::class, 'edit']);
        Route::get('update/{comment_id}', [CommentController::class, 'update'])->name('comments.update');

        Route::get('destroy/{comment_id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });

});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
