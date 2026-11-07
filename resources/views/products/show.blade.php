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
        <p><button class='btn btn-success'>いいねボタン実装予定(非同期処理)</button></p>
    </div>
</div>
{{-- カートボタン・戻る --}}
<div class="mt-3">
    <a href = '{{ route('sale.buy',['id' => $product->id]) }}'class="btn btn-primary">カートに追加する</a> 
    <a href="{{ route('index') }}" class="btn btn-secondary">戻る</a>
</div>

@endsection