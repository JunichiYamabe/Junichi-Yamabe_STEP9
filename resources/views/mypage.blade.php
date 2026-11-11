@extends('layouts.app')

@section('content')

  <h1 class="mb-4">マイページ</h1>
  <div class="card mb-4">
      <div class="card-header">{{ __('ユーザー情報') }}
        <a href="{{ route('mypage.edit', Auth::id()) }}" class="btn btn-primary btn-sm float-right ms-4">アカウント編集（リンク先未実装）</a>
      </div>
      <div class="card-body">
          <p><strong>ユーザー名:</strong> {{ Auth::user()->name }}</p>
          <p><strong>名前:</strong> {{ Auth::user()->name_kanji }}</p>
          <p><strong>カナ:</strong> {{ Auth::user()->name_kana }}</p>
          <p><strong>メールアドレス:</strong> {{ Auth::user()->email }}</p>
      </div>
  </div>

  <div class="card mb-4">
      <div class="card-header">{{ __('出品商品') }}<a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right ms-4">新規登録</a></div>
      <div class="card-body">
          @if ($products->isEmpty())
              <p>出品した商品はありません。</p>
          @else
              <table class="table table-striped">
                  <thead>
                      <tr>
                        <th>商品番号</th>
                          <th>商品名</th>
                          <th>商品説明</th>
                          <th>料金(¥)</th>
                          <th></th> 
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($products as $product)
                          <tr>
                              <td>{{ $product->id }}</td>
                              <td>{{ $product->product_name }}</td>
                              <td>{{ $product->description }}</td>
                              <td>{{ number_format($product->price) }}</td>
                              <td><a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-success btn-sm">詳細</a></td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          @endif


  <div class="card mb-4">
      <div class="card-header">{{ __('購入履歴') }}</div>
      <div class="card-body">
          @if ($sales->isEmpty())
              <p>購入履歴はありません。</p>
          @else
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>商品名</th>
                          <th>商品説明</th>
                          <th>価格(¥)</th>
                          <th>個数</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($sales as $purchase)
                          <tr>
                              <td>{{ $purchase->product_name }}</td>
                              <td>{{ $purchase->description }}</td>
                              <td>{{ number_format($purchase->price) }}</td>
                              <td>{{ $purchase->quantity }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          @endif
      </div>
  </div>

  @endsection
