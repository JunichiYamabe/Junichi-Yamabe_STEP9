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
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.get');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.get');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// --- 商品・一般画面 ---
// 商品一覧画面（ルートURL）
Route::get('/', [IndexController::class, 'index'])->name('index');

// 商品詳細画面
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


// --- 購入関連 (要ログイン) ---
Route::middleware('auth')->group(function () {
    Route::get('/product/{id}/buy', [SaleController::class, 'buy'])->name('sale.buy');
    Route::post('/product/{id}/buy', [SaleController::class, 'buyConfirm'])->name('sale.buyConfirm');
    Route::post('/product/{id}/buy/complete', [SaleController::class, 'buyComplete'])->name('sale.buyComplete');
});


// --- 管理・出品者向け商品操作 (要ログイン) ---
Route::middleware('auth')->group(function () {
    Route::get('/product/create', [AdminProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [AdminProductController::class, 'store'])->name('product.store');
    
    Route::get('/product/{id}/edit', [AdminProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/{id}/update', [AdminProductController::class, 'update'])->name('product.update');
    Route::post('/product/{id}/delete', [AdminProductController::class, 'destroy'])->name('product.destroy');
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