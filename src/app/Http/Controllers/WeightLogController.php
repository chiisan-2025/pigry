<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreWeightLogRequest;
use App\Http\Requests\UpdateWeightLogRequest;

class WeightLogController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $logs = WeightLog::where('user_id', $userId)
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate(8);

        // 目標体重（weight_targetテーブル）
        $targetWeight = WeightTarget::where('user_id', $userId)->value('target_weight');

        // 最新（現在）体重（weight_logsテーブル）
        $latestWeight = WeightLog::where('user_id', $userId)
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->value('weight');

        // 目標まで（現在体重 - 目標体重）
        $diffToTarget = null;
        if (!is_null($latestWeight) && !is_null($targetWeight)) {
            $diffToTarget = $latestWeight - $targetWeight;
        }

            $modal = $request->query('modal'); // 'create' or 'edit' or null
            $editingLog = null;

        if ($modal === 'edit' && $request->filled('id')) {
            $editingLog = WeightLog::where('user_id', $userId)
            ->where('id', $request->id)
            ->firstOrFail();
        }

        // 検索表示用（通常一覧では0件表示など出さない）
        $count = null;

        return view('weight_logs.index', compact(
            'logs',
            'targetWeight',
            'latestWeight',
            'diffToTarget',
            'count',
            'modal',
            'editingLog'
        ));
    }

    public function create()
    {
        return view('weight_logs.create');
    }

    public function store(StoreWeightLogRequest $request)
    {
        WeightLog::create(array_merge(
            ['user_id' => Auth::id()],
            $request->validated()
        ));

        return redirect()->route('weight_logs.index');
    }

    public function edit(WeightLog $weightLog)
    {
        abort_unless($weightLog->user_id === Auth::id(), 403);

        return view('weight_logs.edit', compact('weightLog'));
    }

    public function update(UpdateWeightLogRequest $request, WeightLog $weightLog)
    {
        abort_unless($weightLog->user_id === Auth::id(), 403);

        $weightLog->update($request->validated());

        return redirect()->route('weight_logs.index');
    }

    public function destroy(WeightLog $weightLog)
    {
        abort_unless($weightLog->user_id === Auth::id(), 403);

        $weightLog->delete();

        return redirect()->route('weight_logs.index');
    }

    public function search(Request $request)
    {
        $userId = Auth::id();

        $query = WeightLog::where('user_id', $userId);

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        // 件数（検索結果表示用）
        $count = (clone $query)->count();

        $logs = $query->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate(8)
            ->withQueryString();

        $periodText = null;
        if ($request->filled('date_from') || $request->filled('date_to')) {
            $from = $request->filled('date_from')
            ? \Carbon\Carbon::parse($request->date_from)->format('Y/m/d')
            : '指定なし';

            $to = $request->filled('date_to')
            ? \Carbon\Carbon::parse($request->date_to)->format('Y/m/d')
            : '指定なし';

            $periodText = "{$from} 〜 {$to}";
        }

        // US004表示用：目標/最新/目標まで
        $targetWeight = WeightTarget::where('user_id', $userId)->value('target_weight');

        $latestWeight = WeightLog::where('user_id', $userId)
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->value('weight');

        $diffToTarget = null;
        if (!is_null($latestWeight) && !is_null($targetWeight)) {
            $diffToTarget = $latestWeight - $targetWeight;
        }

        return view('weight_logs.index', compact(
            'logs',
            'count',
            'periodText',
            'targetWeight',
            'latestWeight',
            'diffToTarget'
        ));
    }
}
