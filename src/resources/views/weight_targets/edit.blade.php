<h1>目標体重の変更</h1>

@if ($errors->any())
  <ul>
    @foreach ($errors->all() as $error)
      <li style="color:red">{{ $error }}</li>
    @endforeach
  </ul>
@endif

<form method="POST" action="{{ route('weight_target.update') }}">
  @csrf
  @method('PUT')

  <div>
    <label>目標体重</label>
    <input name="target_weight" value="{{ old('target_weight', $target->target_weight) }}">
  </div>

  <button type="submit">更新</button>
</form>

<a href="{{ route('weight_logs.index') }}">戻る</a>