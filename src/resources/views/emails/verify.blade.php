<!DOCTYPE html>
<html>
<head>
    <title>メール認証</title>
</head>
<body>
    <h1>メール認証</h1>
    <p>以下のリンクをクリックして、メールアドレスを認証してください。</p>
    <a href="{{ url('email/verify/' . $token) }}">メールアドレスを認証する</a>
</body>
</html>
