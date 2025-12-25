<?php

namespace App\Http\Controllers;

use App\Models\WeightTarget;
use App\Http\Requests\UpdateWeightTargetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeightTargetController extends Controller
{
    public function edit()
    {
        $target = WeightTarget::firstOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => 50]
        );

        return view('weight_targets.edit', compact('target'));
    }

    public function update(UpdateWeightTargetRequest $request)
    {
        WeightTarget::updateOrCreate(
        ['user_id' => Auth::id()],
        ['target_weight' => $request->input('target_weight')]);

        return redirect()->route('weight_logs.index');
    }
}