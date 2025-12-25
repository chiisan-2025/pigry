<h1>PiGLy</h1>
<h2>新規会員登録</h2>
<p>STEP2 体重データの入力</p>

<form method="POST" action="/register/step2">
    @csrf

    <div>
        <label>現在の体重</label>
        <div>
            <input
            type="number"
            name="current_weight"
            step="0.1"
            placeholder="現在の体重を入力"
            value="{{ old('current_weight') }}"
            >
            <span>kg</span>
        </div>
        @error('current_weight')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>目標の体重</label>
        <div>
            <input
            type="number"
            name="target_weight"
            step="0.1"
            placeholder="目標の体重を入力"
            value="{{ old('target_weight') }}"
            >
            <span>kg</span>
        </div>
        @error('target_weight')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">アカウント作成</button>
</form>