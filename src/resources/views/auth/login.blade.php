@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        <h1 class="auth-logo">PiGLy</h1>
        <h2 class="auth-title">ログイン</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="auth-field">
        <label>メールアドレス</label>
        <input name="email" value="{{ old('email') }}">
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror
        </div>

        <div class="auth-field">
        <label>パスワード</label>
        <input name="password" type="password">
        @error('password')
            <p class="error">{{ $message }}</p>
        @enderror
        </div>

        <button type="submit" class="btn primary auth-btn">ログイン</button>
    </form>

    <a href="{{ url('/register/step1') }}" class="auth-link">
      アカウント作成はこちら
    </a>

  </div>
</div>