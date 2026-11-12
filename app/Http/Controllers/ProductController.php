<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // 画像の保存
        $imagePath = null;
        if ($request->hasFile('img_path')) {
            $imagePath = $request->file('img_path')->store('images', 'public');
        }

        // 商品の作成
        Product::create([
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'img_path' => $imagePath,
            'stock' => $request->input('stock'),
            'user_id' => Auth::id()
        ]);

        return redirect()->route('index')->with('success', '商品が登録されました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function adminShow(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.admin_products', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //商品削除
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('index')->with('success', '商品が削除されました。');
    }
}
