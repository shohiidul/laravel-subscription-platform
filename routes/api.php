<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('posts')->group(function () {
    Route::post('/create', [PostController::class, 'store'])->name('posts.store');
    Route::get('/show/{post}/post', [PostController::class, 'show'])->name('posts.show');
});

Route::prefix('subscribe')->group(function () {
    Route::get('/', [SubscriptionsController::class, 'index'])->name('subscribe.index');
    Route::get('/verify-email/key/{secure_string}', [SubscriptionsController::class, 'verify_email'])->name('subscribe.verify_email');
});

