<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // index と search を1つにまとめる
    public function index(Request $request)
    {
        $query = Product::query();

        // 1. 商品名で検索
        $product_name = $request->input('product_name');
        if (!empty($product_name)) {
            $query->where('product_name', 'like', '%' . $product_name . '%');
        }

        // 2. 最低価格と最高価格の取得
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if (!empty($minPrice)) {
            $query->where('price', '>=', $minPrice);
        }

        if (!empty($maxPrice)) {
            $query->where('price', '<=', $maxPrice);
        } 

        // 常に paginate(10) を使うことで、通常の全件表示でも検索結果でもページネーションが効く
        $products = $query->paginate(10);
        
        return view('index', compact('products'));
    }
}