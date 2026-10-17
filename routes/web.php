<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\RegisterController;

Auth::routes();

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

//登録処理
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

//ログイン
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
//ログアウト
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');