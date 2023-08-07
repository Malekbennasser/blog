<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
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
    return view('welcome');
})->name('home');

// LOGIN and LOGOUT
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login.show');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register.show');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

//POST
Route::resource('/posts', PostController::class);
Route::put('/posts/{post}/{imageName}', [PostController::class, 'update'])->name('posts.update');

//COMMENT
Route::post('/posts/{postId}/comment', [CommentController::class, 'store'])->name('post.comment');
Route::delete('/posts/{postId}/comment/{id}', [CommentController::class, 'destroy'])->name('delete.comment');

//LIKE
Route::post('/posts/{postId}/like', [LikeController::class, 'store'])->name('post.like');

//PROFILE
Route::get('/profile', [AuthController::class, 'showProfile'])->name('auth.profile.show');
