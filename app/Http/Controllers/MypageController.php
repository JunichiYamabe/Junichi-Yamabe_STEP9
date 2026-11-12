<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

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

    public function edit()
    {
        $user = Auth::user(); // 現在のログインユーザーを取得
        return view('auth.edit', compact('user'));
    }

    public function update(UserRequest $request)
    {
        $user = Auth::user(); // 現在のログインユーザーを取得
        // すでに安全なデータだけが入っていることが保証されている
        $user->update($request->validated());

        return redirect()->route('mypage')->with('success', 'プロフィールを更新しました。');
    }
}
