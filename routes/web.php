<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


// --- 認証関連 ---
Auth::routes();


// --- 商品・一般画面 ---
// 商品一覧画面（ルートURL）
Route::get('/', [IndexController::class, 'index'])->name('index');

//商品登録画面
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// 商品登録処理
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// 商品詳細画面
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
//商品削除
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');



// --- 購入関連 (要ログイン) ---
Route::middleware('auth')->group(function () {
    Route::get('/products/{id}/buy', [SaleController::class, 'buy'])->name('sale.buy');
    Route::post('/products/{id}/buy', [SaleController::class, 'buyConfirm'])->name('sale.buyConfirm');
    Route::post('/products/{id}/buy/complete', [SaleController::class, 'buyComplete'])->name('sale.buyComplete');
});


// --- 管理・出品者向け商品操作 (要ログイン) ---
Route::middleware('auth')->group(function () {
    Route::resource('admin/products', AdminProductController::class)->names('admin.products');
});


// --- マイページ・アカウント関連 (要ログイン) ---
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [MypageController::class, 'mypage'])->name('mypage');
    
    // アカウント編集
    Route::get('/mypage/edit', [MypageController::class, 'edit'])->name('mypage.edit');
    Route::post('/mypage/update', [MypageController::class, 'update'])->name('mypage.update');
});


// --- お問い合わせ ---
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');