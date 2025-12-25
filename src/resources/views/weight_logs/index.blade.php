@extends('layouts.app')

@section('content')
<div class="wl-page">

  {{-- 上の3カード --}}
  <section class="wl-summary">
    <div class="wl-summary-card">
      <div class="wl-summary-label">目標体重</div>
      <div class="wl-summary-value">
        {{ isset($targetWeight) ? number_format($targetWeight, 1) : '-' }}
        <span class="wl-unit">kg</span>
      </div>
    </div>

    <div class="wl-summary-card wl-summary-center">
      <div class="wl-summary-label">目標まで</div>
      <div class="wl-summary-value">
        {{ isset($diffToTarget) ? number_format($diffToTarget, 1) : '-' }}
        <span class="wl-unit">kg</span>
      </div>
    </div>

    <div class="wl-summary-card">
      <div class="wl-summary-label">最新体重</div>
      <div class="wl-summary-value">
        {{ isset($latestWeight) ? number_format($latestWeight, 1) : '-' }}
        <span class="wl-unit">kg</span>
      </div>
    </div>
  </section>

  {{-- 検索 + 右側ボタン --}}
  <section class="wl-toolbar">
    <div class="wl-toolbar-left">
      <form class="wl-search" method="GET" action="{{ route('weight_logs.search') }}">
        <input class="wl-date" type="date" name="date_from" value="{{ request('date_from') }}">
        <span class="wl-tilde">〜</span>
        <input class="wl-date" type="date" name="date_to" value="{{ request('date_to') }}">
        <button class="wl-btn wl-btn-gray" type="submit">検索</button>
        <a class="wl-reset" href="{{ route('weight_logs.index') }}">リセット</a>
      </form>

      @if(!is_null($count))
        <p class="wl-result">{{ $periodText }} の検索結果 {{ $count }}件</p>
      @endif
    </div>

    <a class="wl-btn wl-btn-grad" href="{{ route('weight_logs.create') }}">データ追加</a>
  </section>

  {{-- テーブル --}}
  <section class="wl-table-wrap">
    <table class="wl-table">
      <thead>
        <tr>
          <th>日付</th>
          <th>体重</th>
          <th>食事摂取カロリー</th>
          <th>運動時間</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        @forelse ($logs as $log)
          <tr>
            <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>

            <td>{{ number_format($log->weight, 1) }}kg</td>

            <td>
              {{ $log->calories !== null ? $log->calories . 'cal' : '-' }}
            </td>

            <td>
              @if($log->exercise_time)
                {{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}
              @else
                -
              @endif
            </td>

            <td class="wl-edit">
              <a class="wl-pencil" href="{{ route('weight_logs.edit', $log) }}">✏️</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="wl-empty">データがありません</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {{-- ページネーション --}}
    @if(method_exists($logs, 'links'))
      <div class="wl-pagination">
        {{ $logs->links('pagination::simple-default') }}
      </div>
    @endif
  </section>

</div>
@endsection