@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品一覧') }}</div>
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>商品番号</th>
                        <th>商品名</th>
                        <th>商品説明</th>
                        <th>画像</th>
                        <th>料金</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($products as $product)
                      <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td><img src="{{ $product->img_path }}" alt="{{ $product->name }}" width="100"></td>
                        <td>{{ $product->price }}</td>
                        <td><a href="{{ route('sale.show', ['id' => $product->id]) }}" class="btn btn-primary">詳細</a></td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="6">商品が見つかりません。</td>
                      </tr>
                      @endforelse
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
