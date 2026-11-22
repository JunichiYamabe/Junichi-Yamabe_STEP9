<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeProduct(Request $request, $product_id)
    {
        $user = auth()->user();
        $product = \App\Models\Product::findOrFail($product_id);

        // Check if the user has already liked the product
        if ($product->likedBy($user)) {
            // If already liked, remove the like
            $product->likes()->where('user_id', $user->id)->delete();
            return response()->json(['message' => 'いいねを取り消しました。']);
        } else {
            // If not liked, add a new like
            $product->likes()->create(['user_id' => $user->id]);
            return response()->json(['message' => 'いいねしました。']);
        }
    }
}
