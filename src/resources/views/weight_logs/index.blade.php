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
    <h1>体重ログ一覧</h1>
        <p>目標体重：{{ isset($targetWeight) ? number_format($targetWeight, 1) . 'kg' : '-' }}</p>
        <p>最新（現在）体重：{{ isset($latestWeight) ? number_format($latestWeight, 1) . 'kg' : '-' }}</p>
        <p>目標まで：{{ isset($diffToTarget) ? number_format($diffToTarget, 1) . 'kg' : '-' }}</p>

        <p>
            <a href="{{ route('weight_logs.index', ['modal' => 'create']) }}">
            ＋ 体重ログを追加
            </a>
        </p>

        <p>
            <a href="{{ route('weight_target.edit') }}">目標体重を変更</a>
        </p>


    {{-- 検索（from/to） --}}
    <form method="GET" action="{{ route('weight_logs.search') }}">
        <label>開始日:
            <input type="date" name="date_from" value="{{ request('date_from') }}">
        </label>

        <label>終了日:
            <input type="date" name="date_to" value="{{ request('date_to') }}">
        </label>

    <button type="submit">検索</button>
    <a href="{{ route('weight_logs.index') }}">リセット</a>
    </form>
    @if(!is_null($count))
        <p>{{ $periodText }} の検索結果 {{ $count }}件</p>
    @endif
    <br>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
            <th>日付</th>
            <th>体重</th>
            <th>摂取カロリー</th>
            <th>運動時間</th>
            <th>運動内容</th>
            <th>操作</th>
            </tr>
        </thead>


        <tbody>
            @forelse ($logs as $log)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>

                    <td>{{ number_format($log->weight, 1) }}kg</td>

                    <td>{{ $log->calories !== null ? $log->calories . 'kcal' : '-' }}</td>

                    <td>
                        @if($log->exercise_time)
                            {{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}
                        @else
                          -
                        @endif
                    </td>

                    <td>{{ $log->exercise_content ?? '-' }}</td>

                        <td>
                            <a href="{{ route('weight_logs.edit', $log) }}">✏️</a>

                            <form method="POST" action="{{ route('weight_logs.destroy', $log) }}" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('削除しますか？')">削除</button>
                            </form>
                        </td>
                </tr>
            @empty
                <tr><td colspan="6">データがありません</td></tr>
            @endforelse
        </tbody>

    </table>

    @if(method_exists($logs, 'links'))
        {{ $logs->links('pagination::simple-default') }}
    @endif

@php
  $isOpen = in_array($modal, ['create','edit'], true);
@endphp

@if($isOpen)
  <div class="modal-backdrop">
    <div class="modal">
      <div class="modal-header">
        <h2>{{ $modal === 'create' ? 'Weight Log を追加' : 'Weight Log を編集' }}</h2>

        <a class="modal-close" href="{{ route('weight_logs.index') }}">×</a>
      </div>

      <form method="POST"
        action="{{ $modal === 'create'
          ? route('weight_logs.store')
          : route('weight_logs.update', $editingLog) }}">

        @csrf
        @if($modal === 'edit')
          @method('PUT')
        @endif

        @include('weight_logs._form', ['editingLog' => $editingLog])

        <div class="modal-actions">
          <a class="btn" href="{{ route('weight_logs.index') }}">戻る</a>
          <button type="submit" class="btn primary">
            {{ $modal === 'create' ? '登録' : '更新' }}
          </button>
        </div>
      </form>
    </div>
  </div>
@endif

@endsection