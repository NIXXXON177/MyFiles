<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Грузовозофф - Вход</title>
    <link rel="stylesheets" href={{ asset("css/login.css") }}
</head>
<body>
<div class="login-container">
    <div class="logo">
        <h1>Грузовозофф</h1>
    </div>
    <form method="POST">
        @csrf
        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text"
                   name="login"
                   placeholder="Введите ваш логин"
                   @error('login') class="error" @enderror
                   required>
            @error('login')
            <div class="error-message">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password"
                   name="password"
                   placeholder="Введите ваш пароль"
                   @error('password') class="error" @enderror
                   required>
            @error('password')
            <div class="error-message">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn-login">Войти</button>
    </form>

    <div class="register-link">
        Нет аккаунта? <a href="/register">Зарегистрируйтесь</a>
    </div>
</div>
</body>
</html>
