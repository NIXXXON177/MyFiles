<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <style>
        body { background: #0f172a; color:#e2e8f0; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial; }
        a { color:#60a5fa; font-weight:600; }
        .box { text-align:center; }
        .status { background:#064e3b; border:1px solid #10b981; padding:10px 12px; border-radius:10px; margin-bottom:12px; }
    </style>
</head>
<body>
<div class="box">
    @if (session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif
    <h1>Добро пожаловать</h1>
    <p><a href="{{ route('register.show') }}">Регистрация</a></p>
</div>
</body>
</html>
