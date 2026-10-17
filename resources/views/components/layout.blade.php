<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
</head>
<body>
  <header class= "d-flex flex-wrap justify-content-center py-3 mb-4 bg-primary-subtitle">
    <a href="{{ route('index') }}">Home</a>
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>
    <h1>{{ $title }}</h1>
    <div class="col-4">
      <div class="col-8">ログインユーザー: {{ Auth::user()->name ?? 'ゲスト' }}</div>
      <div class="col">
        @auth
          <form id="logout-form" method="POST" action="{{ route('logout') }} style="display: none;">
            @csrf
          </form>
            <a class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>          
        @endauth
      </div>
    </div>
  </header>
  <div class="container">
    {{ $slot }}
  </div>

  <footer class="d-flex flex-wrap justify-content-center py-3 my-4 border-top">
    <p class="text-center text-muted">&copy; 2026 TNG_Blog</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>