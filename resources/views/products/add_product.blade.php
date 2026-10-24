@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品登録</h1>
    <form action="{{ route('items.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">価格</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="description">商品説明</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="lot-group">
            <label for="stock">在庫数</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>
        <div class="form-group">
            <label for="image">商品画像</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
        </div>
        
        <button type="submit" class="btn btn-primary">追加</button>
    </form>
</div>
@endsection