<?php

// use App\Models\User;
// use App\Models\Post;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::group(['prefix' => 'posts/', 'as' => 'posts.'], function(){
    
    Route::get('{post}', [PostController::class, 'show'])->name("show");
    Route::get('', [PostController::class, 'getOnlyAllPosts']);
    
    Route::group(['middleware' => ['auth']], function () {
        
        Route::post('', [PostController::class, 'store'])->name("store");
        Route::get('edit/{post}', [PostController::class, 'showEdit'])->name("edit");
        Route::put('{post}', [PostController::class, 'update'])->name("update");
        Route::delete('{post}', [PostController::class, 'destroy'])->name("destroy");
        
        //comment related routes
        Route::post('{post}/comments', [CommentController::class, 'store'])->name("comments.store");
    });
});

//home page no css, only user posts
Route::get('/test', [PostController::class, 'getUserPosts'])->name("dashboard2");

//home page 2.0 all posts displayed, Twitter like template used
Route::get('/', [DashboardController::class, 'index'])->name("dashboard");
