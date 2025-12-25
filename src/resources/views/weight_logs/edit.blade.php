@extends('layouts.app')

@push('styles')
<style>
.edit-icon {
    text-decoration: none;
    font-size: 18px;
    cursor: pointer;
    transition: opacity 0.2s ease, transform 0.2s ease;
}
.edit-icon:hover {
    opacity: 0.6;
    transform: scale(1.1);
}
</style>
@endpush

@section('content')

<h1>体重ログ編集</h1>

<form method="POST" action="{{ route('weight_logs.update', $weightLog) }}">
    @csrf
    @method('PUT')

    <div>
        <label>日付</label>
        <input type="date" name="date" value="{{ old('date', $weightLog->date) }}">
        @error('date')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>体重</label>
        <input type="number" name="weight" step="0.1" value="{{ old('weight', $weightLog->weight ?? '') }}">
        @error('weight') <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>カロリー</label>
        <input type="text" name="calories" input="numeric" value="{{ old('calories', $weightLog->calories ?? '') }}">
        @error('calories') <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>運動時間</label>
        <input type="text" name="exercise_time"  placeholder="00:00" value="{{ old('exercise_time', $weightLog->exercise_time) }}">
        @error('exercise_time') <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>運動内容</label>
        <textarea name="exercise_content">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
        @error('exercise_content') <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">更新</button>
</form>

<a href="{{ route('weight_logs.index') }}">戻る</a>
@endsection