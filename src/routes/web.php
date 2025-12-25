<?php
use App\Http\Controllers\Auth\RegisterStepController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\WeightTargetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::middleware('guest')->group(function () {
    Route::get('/register', fn() => redirect('/register/step1'));

    Route::get('/register/step1', [RegisterStepController::class, 'step1']);
    Route::post('/register/step1', [RegisterStepController::class, 'postStep1']);

    Route::get('/register/step2', [RegisterStepController::class, 'step2']);
    Route::post('/register/step2', [RegisterStepController::class, 'postStep2']);

    // ログイン画面は自作（POST /login は Fortify が受ける）
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');


Route::middleware('auth')->group(function () {
    // 一覧
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');

    // 追加
    Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');

    // 編集
    Route::get('/weight_logs/{weightLog}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
    Route::put('/weight_logs/{weightLog}', [WeightLogController::class, 'update'])->name('weight_logs.update');

    // 削除
    Route::delete('/weight_logs/{weightLog}', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');

    // 検索（まずは日付範囲だけでOK）
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');

    // 目標体重（編集・更新）
    Route::get('/weight_target/edit', [WeightTargetController::class, 'edit'])->name('weight_target.edit');
    Route::put('/weight_target', [WeightTargetController::class, 'update'])->name('weight_target.update');
});
Route::get('/', function () {
    return redirect()->route('weight_logs.index');
});