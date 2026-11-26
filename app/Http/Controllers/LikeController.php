<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class LikeController extends Controller
{
    public function likeProduct(Request $request, $product_id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($product_id);

        if ($product->likedBy($user)) {
            $product->likes()->where('user_id', $user->id)->delete();
            $liked = false;
            $message = 'いいねを取り消しました。';
        } else {
            $product->likes()->create(['user_id' => $user->id]);
            $liked = true;
            $message = 'いいねしました。';
        }

        return response()->json([
            'liked'       => $liked,
            'likes_count' => $product->likes()->count(),
            'message'     => $message,
        ]);
    }
}