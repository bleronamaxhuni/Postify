<?php

use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
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
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
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
    Route::post('/like-post', [LikesController::class, 'likePost'])->name('like-post');
    Route::post('/unlike-post', [LikesController::class, 'unlikePost'])->name('unlike-post');
});

require __DIR__.'/auth.php';
