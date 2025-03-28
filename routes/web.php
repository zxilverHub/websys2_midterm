<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('register');
});

Route::get('editpage/{id}', [UserController::class, 'editpage']);
Route::view('home', 'home');
Route::view('loginpage', 'loginpage');
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('delete/{id}', [UserController::class, 'delete']);
Route::post('edit', [UserController::class, 'edit']);
Route::get('home/{id?}', [UserController::class, 'home']);
Route::post('homesearch', [UserController::class, 'homesearch']);
