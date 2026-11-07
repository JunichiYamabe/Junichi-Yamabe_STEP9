<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    // 1. 購入画面の表示
    public function buy($id)
    {
        $product = Product::findOrFail($id);
        return view('products.buy', compact('product'));
    }

    // 2. 購入完了・確定処理（DBトランザクション）
    public function buyComplete(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity');

        // バリデーション
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        try {
            DB::transaction(function () use ($product, $quantity) {
                // 在庫の減算
                $product->stock -= $quantity;
                $product->save();
            });

            return redirect()->route('index')->with('success', '商品を購入しました！');

        } catch (\Exception $e) {
            return back()->with('error', '購入処理に失敗しました。');
        }
    }
}