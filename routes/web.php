<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedPostController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [PostsController::class, 'dashboard'])->name('posts.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile',);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/picture', [ProfileController::class, 'deletePicture'])->name('profile.delete-picture');
    // Posts
    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::post('/posts/create', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');
    // LIKES
    Route::get('/like-post', [LikesController::class, 'index'])->name('liked-posts.index');
    Route::post('/like-post', [LikesController::class, 'likePost'])->name('like-post');
    Route::post('/unlike-post', [LikesController::class, 'unlikePost'])->name('unlike-post');

    // COMMENTS
    Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');

    // SAVED POST
    Route::get('/saved-posts', [SavedPostController::class, 'index'])->name('saved-posts.index');
    Route::post('/saved-posts', [SavedPostController::class, 'store'])->name('saved-posts.store');
    Route::delete('/saved-posts', [SavedPostController::class, 'destroy'])->name('saved-posts.destroy');
});

require __DIR__.'/auth.php';
