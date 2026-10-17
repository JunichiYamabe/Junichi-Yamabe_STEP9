<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\RegisterController;

Auth::routes();
//商品一覧
Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
//マイページ
Route::get('/mypage', [App\Http\Controllers\MypageController::class, 'mypage'])->name('mypage')->middleware('auth');
//お問い合わせ
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact');

//登録処理
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

//ログイン
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
//ログアウト
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');