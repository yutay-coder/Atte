<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-size:16px;
            margin: 5px;
        }
        h1 {
            font-size: 40px;
            color: white;
            text-shadow: 1px 0 5px #289ADC;
            letter-spacing: -4px;
            margin-left: 10px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #289ADC;
            padding: 10px 20px;
        }
        .header a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
            .header button {
            background-color: transparent;
            border: none;
            color: white;
            cursor: pointer;
        }
        .content {
            margin:10px;
        }
        footer {
                text-align: center;
                padding: 20px;
                background-color: #f1f1f1;
            }
    </style>
</head>
<body>
    <header class="header">
        <!-- ヘッダーの内容 -->
        <div>
            <h1>Atte</h1>
        </div>
        <nav>
            <a href="{{ route('attendance.index') }}">ホーム</a>
            <a href="{{ url('attendance') }}">日付一覧</a>
            @auth
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- フッターの内容 -->
        &copy; {{ date('Y') }} Atte. All rights reserved.
    </footer>
</body>
</html>
