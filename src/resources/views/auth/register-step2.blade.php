@extends('layouts.app')

@section('content')

<div class="auth-wrapper">
  <div class="auth-card">

    <h1 class="auth-logo">PiGLy</h1>
    <h2 class="auth-title">新規会員登録</h2>
    <p class="auth-step">STEP2 体重データの入力</p>

    <form method="POST" action="/register/step2" novalidate>
      @csrf

      <div class="auth-field">
        <label>現在の体重</label>

        <div class="wl-input-unit">
          <input
            type="number"
            name="current_weight"
            step="0.1"
            placeholder="現在の体重を入力"
            value="{{ old('current_weight') }}"
          >
          <span class="unit">kg</span>
        </div>

        @error('current_weight')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <div class="auth-field">
        <label>目標の体重</label>

        <div class="wl-input-unit">
          <input
            type="number"
            name="target_weight"
            step="0.1"
            placeholder="目標の体重を入力"
            value="{{ old('target_weight') }}"
          >
          <span class="unit">kg</span>
        </div>

        @error('target_weight')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="auth-btn">アカウント作成</button>
    </form>

  </div>
</div>