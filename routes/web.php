<?php

// use App\Models\User;
// use App\Models\Post;
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

//home page no css not using
Route::get('/test', [PostController::class, 'getPosts'])->name("dashboard");

//home page 2.0 all posts displ,ayed, Twitter like template used
Route::get('/', [PostController::class, 'getAllPosts'])->name("dashboard");

// redirect to authentication pages : login.b.p register.b.p
Route::get('/login', [UserController::class, 'login'])->name("user.login");
Route::get('/register', [UserController::class, 'register'])->name("user.register");

// actually perform authentication functionalities
Route::post('/registerAction', [UserController::class, 'registerAction'])->name("user.registerAction");
Route::get('/logout', [UserController::class, 'logout'])->name("user.logout");
Route::post('/loginAction', [UserController::class, 'loginAction'])->name("user.loginAction");

// Blog post related routes
Route::post('/posts', [PostController::class, 'createPost'])->name("posts.store");
Route::get('/posts/{post}', [PostController::class, 'showEditScreen'])->name("posts.show");
Route::put('/posts/{post}', [PostController::class, 'actuallyUpdatePost'])->name("posts.update");
Route::delete('/posts/{post}', [PostController::class, 'deletePost'])->name("posts.destroy");