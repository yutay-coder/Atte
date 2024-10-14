<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
</head>

<body>
    <div class="container">
        <h2>会員登録</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">名前:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">メールアドレス:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">パスワード:</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">確認用パスワード:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">会員登録</button><br>
            <label>アカウントをお持ちの方は <a href="{{ route('login') }}">こちら</a> からログインしてください。</label>
        </form>
    </div>
</body>
</html>