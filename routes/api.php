<?php 


use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'login'])->middleware('throttle:10,1');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Route::get('posts', [PostController::class, 'index']);
    // Route::post('posts', [PostController::class, 'store']);

    

    Route::resource('posts', PostController::class)->except(['create', 'edit']);

    // Admin routes
    Route::middleware('can:manage-users')->group(function () {
        Route::get('admin/users', [AdminController::class, 'index']);
        Route::delete('admin/users/{user}', [AdminController::class, 'destroy']);
    });

    Route::middleware('can:manage-posts')->group(function () {
        Route::get('admin/posts', [AdminController::class, 'listPosts']);
        Route::delete('admin/posts/{post}', [AdminController::class, 'destroyPost']);
        
    });
});


