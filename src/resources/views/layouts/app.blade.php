<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>PiGLy</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @stack('styles')
</head>

<body class="@stack('body_class')">
  @auth
    <header class="header">
      <h1 class="logo">PiGLy</h1>

      <div class="header-actions">
        <a href="{{ route('weight_target.edit') }}" class="btn">目標体重設定</a>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn">ログアウト</button>
        </form>
      </div>
    </header>
  @endauth

  <main class="container">
    @yield('content')
  </main>
</body>
</html>