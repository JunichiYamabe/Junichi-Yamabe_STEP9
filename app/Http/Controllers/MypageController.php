<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class MypageController extends Controller
{
   public function mypage()
    {
        // 1. 現在ログインしているユーザーのIDを取得
        $userId = Auth::id();

        // 2. ログインユーザーが登録した商品データを取得（user_id が一致するもの）
        $products = Product::where('user_id', $userId)->get();

        // 3. ログインユーザーの購入履歴データを取得（※ Saleテーブルに user_id がある場合）
        $sales = Sale::where('user_id', $userId)->get();

        // 4. compact関数でビューへデータを渡す
        return view('mypage', compact('products', 'sales'));
    }
}
