<h1>PiGLy</h1>
<h2>新規会員登録</h2>
<p>STEP1 アカウント情報の登録</p>

<form method="POST" action="/register/step1">
    @csrf

    <div>
        <label>お名前</label>
        <div>
            <input
                type="text"
                name="name"
                placeholder="名前を入力"
                value="{{ old('name') }}"
            >
        </div>
        @error('name')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>メールアドレス</label>
        <div>
            <input
            type="email"
            name="email"
            placeholder="メールアドレスを入力"
            value="{{ old('email') }}"
        >
        </div>
        @error('email')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>パスワード</label>
        <div>
            <input
            type="password"
            name="password"
            placeholder="パスワードを入力"
        >
        </div>
        @error('password')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">次に進む</button>
</form>

<a href="{{ url('/login') }}">ログインはこちら</a>