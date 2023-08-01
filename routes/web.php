<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome', ['posts' => Post::orderBy('created_at', 'desc')
        ->where('status', Post::STATUS_PUBLISHED)
        ->orWhere('status', Post::STATUS_ARCHIVED)
        ->paginate(10)]);
});
Route::get('posts/{post}', [PostController::class, 'gotoDetailed'])->name('postsDetailed');

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/posts', [PostController::class, 'index'])->name('posts');
    Route::get('admin/posts/create', [PostController::class, 'gotoCreate'])->name('gotoCreatePost');
    Route::get('admin/comments', [CommentController::class, 'index'])->name('comments');

    Route::post('admin/posts/created', [PostController::class, 'createPost'])->name('createPost');
    Route::post('admin/posts/deleted', [PostController::class, 'deletePost'])->name('deletePost');
    Route::post('admin/posts/change', [PostController::class, 'gotoChange'])->name('gotoChangePost');
    Route::post('admin/posts/changed', [PostController::class, 'changePost'])->name('changePost');
    Route::post('admin/comments/approved', [CommentController::class, 'approveComment'])->name('approveComment');
    Route::post('admin/comments/deleted', [CommentController::class, 'deleteComment'])->name('deleteComment');
});

Route::post('comment/created', [CommentController::class, 'createComment'])->name('createComment');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
