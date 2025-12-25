@extends('layouts.app')

@section('body_class', 'auth-page')

@section('content')
  <div class="auth-wrap">
    <div class="auth-card">
        <h1 class="auth-logo">PiGLy</h1>
        <h2 class="auth-title">新規会員登録</h2>
        <p class="auth-step">STEP1 アカウント情報の登録</p>

        <form method="POST" action="/register/step1" novalidate>
        @csrf

        <div class="auth-field">
            <label>お名前</label>
            <input type="text" name="name" placeholder="名前を入力" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-field">
          <label>メールアドレス</label>
          <input type="email" name="email" placeholder="メールアドレスを入力" value="{{ old('email') }}">
          @error('email')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        <div class="auth-field">
          <label>パスワード</label>
          <input type="password" name="password" placeholder="パスワードを入力">
          @error('password')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        <button class="auth-btn" type="submit">次に進む</button>
        </form>

      <a class="auth-link" href="{{ url('/login') }}">ログインはこちら</a>
    </div>
  </div>
@endsection