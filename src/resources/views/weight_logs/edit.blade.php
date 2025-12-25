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
        position: relative; /* 右下ゴミ箱の基準 */
    }
    .wl-title{
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 18px;
    }

    .wl-field{ margin-bottom: 14px; }
    .wl-field label{
        display: block;
        font-size: 14px;
        color: #555;
        margin-bottom: 6px;
    }

    .wl-card input[type="text"],
    .wl-card input[type="number"],
    .wl-card input[type="date"],
    .wl-card textarea{
        width: 100%;
        box-sizing: border-box;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        outline: none;
    }

    .error{
        color: red;
        margin: 6px 0 0;
        font-size: 13px;
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
        display: inline-block;
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

  /* 右下ゴミ箱 */
    .wl-trash{
        position: absolute;
        right: 16px;
        bottom: 16px;
    }
    .wl-trash button{
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 22px;
    }

    .wl-input-unit {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .wl-input-unit input {
        flex: 1;
    }

    .wl-input-unit .unit {
        color: #666;
        font-size: 14px;
        white-space: nowrap;
    }

    .wl-error {
        color: red;
        font-size: 13px;
        margin-top: 4px;
    }
</style>
@endpush

@section('content')
    <div class="wl-wrap">
        <div class="wl-card">
            <h1 class="wl-title">Weight Log</h1>

        {{-- ブラウザ先ブロックを抑えて Laravel のメッセージを出しやすく --}}
        <form method="POST" action="{{ route('weight_logs.update', $weightLog) }}" novalidate>
            @csrf
            @method('PUT')

        <div class="wl-field">
            <label>日付</label>
            <input type="date" name="date" value="{{ old('date', $weightLog->date) }}">
            @error('date') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="wl-field">
            <label>体重</label>
            <div class="wl-input-unit">
            <input type="number" name="weight" step="0.1" value="{{ old('weight', $weightLog->weight) }}">
            <span class="unit">kg</span></div>
            @error('weight') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="wl-field">
            <label>カロリー</label>
            <div class="wl-input-unit">
            <input type="text" name="calories" inputmode="numeric"
                value="{{ old('calories', $weightLog->calories) }}">
            <span class="unit">cal</span></div>
            @error('calories') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="wl-field">
            <label>運動時間</label>
            <input type="text" name="exercise_time" placeholder="00:00"
                value="{{ old('exercise_time', $weightLog->exercise_time) }}">
            @error('exercise_time') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="wl-field">
            <label>運動内容</label>
            <textarea name="exercise_content">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
            @error('exercise_content') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="wl-actions">
            <a class="wl-btn back" href="{{ route('weight_logs.index') }}">戻る</a>
            <button class="wl-btn primary" type="submit">更新</button>
        </div>
        </form>

        {{-- 削除formは入れ子にしない（カード直下に置く） --}}
        <form class="wl-trash" method="POST" action="{{ route('weight_logs.destroy', $weightLog) }}"
            onsubmit="return confirm('削除しますか？')">
        @csrf
        @method('DELETE')
            <button type="submit" aria-label="削除">🗑️</button>
        </form>

        </div>
    </div>
@endsection