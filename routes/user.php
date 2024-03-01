<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//user related routes

Route::get('users/{user}', [UserController::class, 'profile'])->name("users.profile");

// redirect to authentication pages : login.b.p register.b.p
Route::get('/login', [UserController::class, 'login'])->name("users.login");
Route::get('/register', [UserController::class, 'register'])->name("users.register");

// actually perform authentication functionalities
Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'authenticate']);

//logout
Route::get('/logout', [UserController::class, 'logout'])->name("users.logout");
