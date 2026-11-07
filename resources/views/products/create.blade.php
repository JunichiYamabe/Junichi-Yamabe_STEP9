@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品登録</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group mb-3">
            <label for="product_name">商品名</label>
            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name') }}" required>
            @error('product_name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="price">価格</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" step="0.01" required>
            @error('price')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description">商品説明</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="stock">在庫数</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" required>
            @error('stock')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="img_path">商品画像</label>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="img_path" name="img_path" accept="image/*">
            @error('img_path')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">追加</button>
        <a href="{{ route('index') }}" class="btn btn-secondary mt-3">キャンセル</a>
    </form>
</div>
@endsection