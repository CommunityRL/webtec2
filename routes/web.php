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

//home page
Route::get('/', [PostController::class, 'getPosts'])->name("dashboard");

//home page 2.0 all posts displ,ayed, Twitter like template used
Route::get('test', [PostController::class, 'getAllPosts'])->name("dashboard2");

// redirect to authentication pages : login.b.p register.b.p
Route::get('/login', [UserController::class, 'login'])->name("user.login");
Route::get('/register', [UserController::class, 'register'])->name("user.register");

// actually perform authentication functionalities
Route::post('/registerAction', [UserController::class, 'registerAction'])->name("user.registerAction");
Route::get('/logout', [UserController::class, 'logout'])->name("user.logout");
Route::post('/loginAction', [UserController::class, 'loginAction'])->name("user.loginAction");

// Blog post related routes
Route::post('/create-post', [PostController::class, 'createPost'])->name("post.create");
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen'])->name("post.showEdit");
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost'])->name("post.update");
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->name("post.delete");