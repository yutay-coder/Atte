<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
</head>
<body>
    <div class="container">
        <h2>ログイン</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">ログイン</button><br>
            <label>アカウントをお持ちでない方は <a href="{{ route('register') }}">こちら</a> から登録してください。</label>
        </form>
    </div>
</body>

</html>