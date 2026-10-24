<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cytech EC') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  <header class='d-flex navbar navbar-light bg-white shadow-sm py-3 mb-4'>
    <div class="container">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- 左側：ロゴ -->
        <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">
            Cytech EC
        </a>

        <!-- 右側：ナビメニュー・ユーザー名・ログアウトボタン -->
        <div class="d-flex align-items-center gap-3">
            <a class="nav-link text-primary" href="{{ route('index') }}">Home</a>
            <a class="nav-link text-primary" href="{{ route('mypage') }}">マイページ</a> 
            <span class="text-end text-muted">ログインユーザー: {{ Auth::user()->name ?? 'ゲスト' }}</span>
            <button class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</button>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>
        </div>        
      </div>
  </div>
        
    </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer class="d-flex flex-column align-items-center py-4 my-4 border-top gap-3">
      <div class="d-flex gap-3">
        <a class="btn btn-primary py-2" href="{{ route('contact') }}">お問い合わせ</a>
      </div>
      
      <div class="d-flex gap-3">
        <a href="{{ route('index') }}">Home</a>
        <a href="{{ route('mypage') }}">マイページ</a>
      </div>
      <div class="d-flex gap-3">
        <p class="text-center text-muted">&copy; 2026 TNG_Blog</p>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
