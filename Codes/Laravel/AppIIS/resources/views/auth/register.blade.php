<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji"; background: #0f172a; color: #e2e8f0; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; }
        .card { width: 100%; max-width: 420px; background: #111827; border: 1px solid #1f2937; border-radius: 14px; padding: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.35); }
        h1 { margin: 0 0 18px; font-size: 22px; }
        .field { margin-bottom: 14px; }
        label { display:block; margin-bottom: 6px; font-size: 13px; color:#cbd5e1; }
        input { width: 100%; padding: 10px 12px; border-radius: 10px; border: 1px solid #334155; background: #0b1220; color: #e2e8f0; outline: none; }
        input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.2); }
        .btn { width:100%; background:#3b82f6; color:#fff; border:none; padding:12px 14px; border-radius:10px; cursor:pointer; font-weight:600; }
        .btn:hover { background:#2563eb; }
        .errors { background:#7f1d1d; border:1px solid #ef4444; padding:10px 12px; border-radius:10px; margin-bottom:12px; }
        .status { background:#064e3b; border:1px solid #10b981; padding:10px 12px; border-radius:10px; margin-bottom:12px; }
        a { color:#60a5fa; }
    </style>
</head>
<body>
<div class="card">
    <h1>Регистрация</h1>

    @if ($errors->any())
        <div class="errors">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="field">
            <label for="name">Имя</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="field">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="field">
            <label for="password_confirmation">Подтверждение пароля</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn">Зарегистрироваться</button>
    </form>

    <p style="margin-top:12px; font-size:14px; color:#94a3b8;">
        Уже есть аккаунт? <a href="/">На главную</a>
    </p>
</div>
</body>
</html>
