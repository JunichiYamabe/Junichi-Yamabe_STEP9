@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品編集</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group mb-3">
            <label for="product_name">商品名</label>
            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>
            @error('product_name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="price">価格</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price ) }}" step="0.01" required>
            @error('price')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description">商品説明</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $product->description ) }}</textarea>
            @error('description')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="stock">在庫数</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock ) }}" required>
            @error('stock')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

<div class="form-group mb-3">
    <label for="img_path">商品画像</label>

    {{-- 1. すでに登録されている画像がある場合はプレビューを表示する --}}
    @if(isset($product) && $product->img_path)
        <div class="mb-2">
            <p class="text-muted small mb-1">現在の画像:</p>
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" style="max-height: 100px; max-width: 100px;" class="img-thumbnail">
        </div>
    @endif

    {{-- 2. ファイル選択インプット --}}
    <input type="file" class="form-control-file @error('img_path') is-invalid @enderror" 
           id="img_path" name="img_path" accept="image/*">
           
    <small class="form-text text-muted">既存の画像を変更したい場合のみ選択してください。</small>

    @error('img_path')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>        
        <button type="submit" class="btn btn-primary mt-3">登録</button>
        <a href="{{ route('mypage') }}" class="btn btn-secondary mt-3">戻る</a>
    </form>
</div>
@endsection