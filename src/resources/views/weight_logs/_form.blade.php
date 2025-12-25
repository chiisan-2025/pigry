@php
  // $editingLog が無いときは null
@endphp

 <div class="wl-field">
    <label>日付</label>
    <input type="date" name="date" value="{{ old('date', optional($editingLog)->date) }}">
    @error('date')
      <p style="color:red">{{ $message }}</p>
    @enderror
  </div>

  <div class="wl-field">
    <label>体重</label>
    <input type="number" name="weight" step="0.1" value="{{ old('weight', optional($editingLog)->weight) }}">
    @error('weight')
      <p style="color:red">{{ $message }}</p>
    @enderror

  </div>

  <div class="wl-field">
    <label>カロリー</label>
    <input type="text" name="calories" inputmode="numeric" value="{{ old('calories', optional($editingLog)->calories) }}">
    @error('calories')
      <p style="color:red">{{ $message }}</p>
    @enderror

  </div>

  <div class="wl-field">
    <label>運動時間</label>
    <input type="text" name="exercise_time"
        value="{{ old('exercise_time', optional($editingLog)->exercise_time) }}"
        placeholder="HH:MM">
    @error('exercise_time')
      <p style="color:red">{{ $message }}</p>
    @enderror

  </div>

  <div class="wl-field">
    <label>運動内容</label>
    <textarea name="exercise_content">{{ old('exercise_content', optional($editingLog)->exercise_content) }}</textarea>
    @error('exercise_content')
      <p style="color:red">{{ $message }}</p>
    @enderror
  </div>