<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WormController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/posts');

Route::resource('posts', PostController::class)->only('index');
Route::get('/profile/all', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/{user}', [ProfileController::class, 'specific'])->name('profile.specific');
Route::get('/worms', [WormController::class, 'index'])->name('worms.index');

Route::get('posts/{post}/comments', [CommentController::class, 'index'])
    ->name('comments.index');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('throttle:5,1')
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.store');

    Route::get('/auth/forgot-password', [PasswordResetController::class, 'showForgotPassword'])
        ->name('password.request');

    Route::post('/auth/forgot-password', [PasswordResetController::class, 'sendResetLink'])
        ->middleware('throttle:5,1')
        ->name('password.email');

    Route::get('/auth/reset-password/{token}', [PasswordResetController::class, 'showResetPassword'])
        ->name('password.reset');

    Route::post('/auth/reset-password', [PasswordResetController::class, 'resetPassword'])
        ->middleware('throttle:5,1')
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::resource('posts', PostController::class)
        ->except(['index', 'show']);

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'updatePicture'])->name('profile.update');
    Route::put('/profile/updateName', [ProfileController::class, 'updateName'])->name('profile.updateName');
    Route::put('/profile/updateDesc', [ProfileController::class, 'updateDesc'])->name('profile.updateDesc');
    Route::delete('/profile/{user}', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])
        ->middleware('throttle:10,1')
        ->name('posts.like');

    Route::post('/posts/{post}/report', [ReportController::class, 'report'])
        ->middleware('throttle:10,1')
        ->name('posts.report');
        
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])
        ->middleware('throttle:10,1')
        ->name('reports.destroy');

    Route::post('/comments/{comment}/like', [CommentController::class, 'toggleLike'])
        ->middleware('throttle:10,1')
        ->name('comments.like');

    Route::post('/comments/{comment}/report', [CommentController::class, 'report'])
        ->middleware('throttle:10,1')
        ->name('comments.report');

    Route::delete('/comment-reports/{report}', [ReportController::class, 'destroyCommentReport'])
        ->name('comment-reports.destroy');

    Route::resource('posts.comments', CommentController::class)
        ->shallow() //shallow automatically makes the /post/{id}/comments, /comments/{id}/edit and the other ones
        ->except(['index', 'show'])
        ->names('comments');

    Route::get('/admin', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
});
