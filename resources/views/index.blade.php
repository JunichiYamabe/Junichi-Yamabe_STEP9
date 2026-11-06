@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">商品一覧</h1>
            
            <div class="card mb-4">
                <div class="card-header">{{ __('検索条件') }}</div>
                <div class="card-body">
                    {{-- 検索フォーム --}}
                    <form action="{{ route('index') }}" method="GET" class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">商品名:</label>
                            <input type="text" name="product_name" value="{{ request('product_name') }}" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">価格帯:</label>
                            <div class="input-group">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="最低価格" class="form-control">
                                <span class="input-group-text">〜</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="最高価格" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">検索する</button>
                            <a href="{{ route('index') }}" class="btn btn-secondary">リセット</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('商品一覧') }}</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>商品番号</th>
                                <th>商品名</th>
                                <th>商品説明</th>
                                <th>画像</th>
                                <th>料金</th>
                                <th>詳細画面</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td><img src="{{ $product->img_path }}" alt="{{ $product->name }}" width="100"></td>
                                <td>{{ number_format($product->price) }}円</td>
                                <td><a href="{{ route('sale.show', ['id' => $product->id]) }}" class="btn btn-primary btn-sm">詳細</a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">商品が見つかりません。</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table> 
                    <div class="d-flex justify-content-center mt-4">
                        {{-- ★ appends() をつけて検索条件を次のページへ引き継ぐ --}}
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div> 
            </div> 
        </div>
    </div>
</div>
@endsection