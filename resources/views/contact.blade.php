@extends('layouts.app')

@section('content')

  <h1 class="mb-4">お問い合わせフォーム</h1>
  <form action="{{ route('contact.send') }}" method="POST">
      @csrf

      <div class="form-group mb-3">
          <label for="name">名前</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
          @error('name')
              <div class="text-danger small mt-1">{{ $message }}</div>
          @enderror
      </div>

      <div class="form-group mb-3">
          <label for="email">メールアドレス</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
          @error('email')
              <div class="text-danger small mt-1">{{ $message }}</div>
          @enderror
      </div>

      <div class="form-group mb-3">
          <label for="message">お問い合わせ内容</label>
          <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
          @error('message')
              <div class="text-danger small mt-1">{{ $message }}</div>
          @enderror
      </div>

      <button type="submit" class="btn btn-primary">送信</button>
      <a href="{{ route('index') }}" class="btn btn-secondary">戻る</a>
  </form>
