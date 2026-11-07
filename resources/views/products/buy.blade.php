@extends('layouts.app')

@section('content')

<h1 class="mb-4">購入画面</h1>

<form action="{{ route('sale.buyComplete', $product->id) }}" method="POST" onsubmit="return confirm('この商品を本当に購入しますか？');">
    @csrf

    <div class="card mb-3">
        <div class="card-header">{{ __('商品情報') }}</div>
        <div class="card-body">
            {{-- <p><strong>商品番号:</strong> {{ $product->id }}</p> --}}
            <p><strong>商品名:</strong> {{ $product->product_name }}</p>
            <p><strong>商品説明:</strong> {{ $product->description }}</p>
            @if ($product->img_path)
                <p><strong>画像:</strong></p>
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" width="200" height="200">
                </div>
            @endif

            <div class="form-group mb-3">
                <label for="quantity"><strong>購入数:</strong></label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="{{ $product->stock }}" required>
                @error('quantity')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <p><strong>金額(¥):</strong> {{ number_format($product->price) }}</p>
            <p><strong>残り:</strong> {{ $product->stock }}</p>
            <p><strong>会社:</strong> {{ $product->company_id }}</p>
        </div>
    </div>

    {{-- ボタンエリア --}}
    <div class="mt-3">
        {{-- <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="btn btn-success">カートに追加する</a> --}}
        <button type="submit" class="btn btn-primary">購入する</button>
        <a href="{{ route('index') }}" class="btn btn-secondary">戻る</a>
    </div>
</form>

@endsection