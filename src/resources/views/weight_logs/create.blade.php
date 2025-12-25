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
<h1>体重ログ追加</h1>
<form method="POST" action="{{ route('weight_logs.store') }}">
  @csrf

  @include('weight_logs._form')

  <button type="submit">登録</button>
</form>

<a href="{{ route('weight_logs.index') }}">戻る</a>
@endsection