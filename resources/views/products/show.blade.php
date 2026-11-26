@extends('layouts.app')

@section('content')

<h1 class="mb-4">商品詳細</h1>

<div class="card">
    <div class="card-header">{{ __('商品情報') }}</div>
    <div class="card-body">
        {{-- <p><strong>商品番号:</strong> {{ $product->id }}</p> --}}
        <p><strong>商品名:</strong> {{ $product->product_name }}</p>
        <p><strong>商品説明:</strong> {{ $product->description }}</p>
        @if ($product->img_path)
            <p><strong>画像:</strong></p>
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" width="200" height="200">
        @endif
        <p><strong>金額(¥):</strong> {{ number_format($product->price) }}</p>
        <p><strong>会社:</strong> {{ $product->company_id }}</p>

        {{-- ▼ ここからいいねボタン ▼ --}}
        @auth
            @php
                $isLiked = $product->likedBy(Auth::user());
            @endphp
            <p>
                <button type="button"
                        id="like-btn"
                        class="btn btn-light border"
                        data-url="{{ route('products.like', ['product_id' => $product->id]) }}">
                    <i id="like-icon"
                       class="fa-solid fa-heart"
                       style="color: {{ $isLiked ? 'red' : '#ccc' }};"></i>
                    <span id="like-count">{{ $product->likes()->count() }}</span>
                </button>
            </p>
        @else
            <p>
                <a href="{{ route('login') }}" class="btn btn-light border">
                    <i class="fa-solid fa-heart" style="color: #ccc;"></i>
                    <span>{{ $product->likes()->count() }}</span>
                </a>
            </p>
        @endauth
        {{-- ▲ ここまでいいねボタン ▲ --}}    
    </div>
</div>

{{-- 購入者用カートボタン・戻る --}}
<div class="mt-3">
    <a href = '{{ route('sale.buy',['id' => $product->id]) }}'class="btn btn-primary">購入する</a> 
    <a href="{{ route('index') }}" class="btn btn-secondary">戻る</a>
</div>

@endsection