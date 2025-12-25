<?php

namespace App\Http\Controllers;

use App\Models\WeightTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeightTargetController extends Controller
{
    public function edit()
    {
        $target = WeightTarget::firstOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => 50] // 初期値（適当でOK）
        );

        return view('weight_targets.edit', compact('target'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'target_weight' => ['required', 'numeric', 'between:1,999.9'],
        ]);

        WeightTarget::updateOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => $validated['target_weight']]
        );

        return redirect()->route('weight_logs.index');
    }
}