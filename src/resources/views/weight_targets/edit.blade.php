@extends('layouts.app')

@push('styles')
<style>
  .wl-wrap{
    max-width: 820px;
    margin: 40px auto;
    padding: 0 16px;
  }
  .wl-card{
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 24px rgba(0,0,0,.08);
    padding: 28px 32px;
  }
  .wl-title{
    font-size: 22px;
    font-weight: 700;
    margin: 0 0 18px;
    text-align: center;
  }

  .wl-field{
    margin-top: 14px;
  }
  .wl-field label{
    display: block;
    font-size: 14px;
    color: #555;
    margin-bottom: 8px;
  }

  .wl-input-unit{
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .wl-input-unit input{
    flex: 1;
    width: 100%;
    box-sizing: border-box;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    outline: none;
  }
  .wl-input-unit .unit{
    color: #666;
    font-size: 14px;
    white-space: nowrap;
  }

  .wl-error{
    color: red;
    font-size: 13px;
    margin-top: 6px;
  }

  .wl-actions{
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-top: 22px;
  }
  .wl-btn{
    min-width: 140px;
    padding: 12px 18px;
    border-radius: 8px;
    border: none;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
  }
  .wl-btn.back{
    background: #d9d9d9;
    color: #333;
  }
  .wl-btn.primary{
    background: linear-gradient(90deg, #8a8cff, #ff9ad5);
    color: #fff;
    font-weight: 700;
  }
</style>
@endpush

@section('content')
  <div class="wl-wrap">
    <div class="wl-card">
      <h1 class="wl-title">目標体重設定</h1>

      <form method="POST" action="{{ route('weight_target.update') }}" novalidate>
        @csrf
        @method('PUT')

        <div class="wl-field">
          <label>目標体重</label>

          <div class="wl-input-unit">
            <input
              type="text"
              name="target_weight"
              inputmode="decimal"
              value="{{ old('target_weight', $target->target_weight) }}"
              placeholder="例：59.0"
            >
            <span class="unit">kg</span>
          </div>

          @error('target_weight')
            <p class="wl-error">{{ $message }}</p>
          @enderror
        </div>

        <div class="wl-actions">
          <a class="wl-btn back" href="{{ route('weight_logs.index') }}">戻る</a>
          <button class="wl-btn primary" type="submit">更新</button>
        </div>
      </form>
    </div>
  </div>
@endsection