<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\RegisterController;

Auth::routes();
//商品一覧画面
Route::get('/', [IndexController::class, 'index'])->name('index');

//購入商品詳細画面
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('order.show');

//商品購入画面
Route::get('/product/{id}/buy', [App\Http\Controllers\OrderController::class, 'buy'])->name('order.buy')->middleware('auth');
Route::post('/product/{id}/buy', [App\Http\Controllers\OrderController::class, 'buyConfirm'])->name('order.buyConfirm')->middleware('auth');
Route::post('/product/{id}/buy/complete', [App\Http\Controllers\OrderController::class, 'buyComplete'])->name('order.buyComplete')->middleware('auth');

//商品登録
Route::get('/product/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('product.create')->middleware('auth');
Route::post('/product/store', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('product.store')->middleware('auth');

//出品商品詳細
Route::get('/product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'show'])->name('product.show');
//出品商品編集
Route::get('/product/{id}/edit', [App\Http\Controllers\Admin\ProductController::class,
  'edit'])->name('product.edit')->middleware('auth');
Route::post('/product/{id}/update', [App\Http\Controllers\Admin\ProductController::class,
  'update'])->name('product.update')->middleware('auth');
//出品商品削除
Route::post('/product/{id}/delete', [App\Http\Controllers\Admin\ProductController::class,
  'destroy'])->name('product.destroy')->middleware('auth');

//お問い合わせ画面・送信
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact');
Route::post('/contact/send', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

//マイページ画面
Route::get('/mypage', [App\Http\Controllers\MypageController::class, 'mypage'])->name('mypage')->middleware('auth');



  //新規ユーザー登録画面
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

//ログイン
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
//ログアウト
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');