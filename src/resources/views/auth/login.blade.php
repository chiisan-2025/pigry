<h1>PiGLy</h1>
<h2>ログイン</h2>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label>メールアドレス</label>
        <div>
            <input name="email" value="{{ old('email') }}">
        </div>
        @error('email')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>パスワード</label>
        <div>
            <input name="password" type="password">
        </div>
        @error('password')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">ログイン</button>
</form>

<a href="{{ url('/register/step1') }}">アカウント作成はこちら</a>