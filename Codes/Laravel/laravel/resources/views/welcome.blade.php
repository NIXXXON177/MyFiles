<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Грузовозофф - Главная</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s ease;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        main {
            min-height: calc(100vh - 140px);
            padding: 40px 0;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 50px;
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .welcome-section p {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            margin: 0 auto;
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
            font-weight: 700;
        }

        .form-grid {
            display: grid;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            color: #555;
            font-weight: 600;
            font-size: 14px;
        }

        input {
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .error-message::before {
            content: "⚠";
            font-size: 12px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .user-welcome {
            text-align: center;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 60px 40px;
            max-width: 600px;
            margin: 0 auto;
        }

        .user-welcome h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .user-welcome p {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .btn-dashboard {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-dashboard:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 30px 0;
            margin-top: 50px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        @media (max-width: 768px) {
            .nav-bar {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                gap: 20px;
            }

            .form-container {
                margin: 0 20px;
                padding: 30px 20px;
            }

            .welcome-section h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <div class="nav-bar">
            <div class="logo">Грузовозофф</div>
            <nav class="nav-links">
                <a href="/">Главная</a>
                <a href="/about">О нас</a>
                <a href="/services">Услуги</a>
                <a href="/contact">Контакты</a>
            </nav>
        </div>
    </div>
</header>

<main class="container">
    @guest
        <div class="welcome-section">
            <h1>Добро пожаловать в Грузовозофф</h1>
            <p>Присоединяйтесь к нашей платформе для эффективной логистики</p>
        </div>

        <div class="form-container">
            <h2 class="form-title">Регистрация</h2>
            <form method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="login">Логин:</label>
                        <input type="text"
                               name="login"
                               placeholder="Придумайте логин"
                               required>
                        @error('login')
                        <div class="error-message">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Пароль:</label>
                        <input type="password"
                               name="password"
                               placeholder="Придумайте пароль"
                               required>
                        @error('password')
                        <div class="error-message">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fio">ФИО:</label>
                        <input type="text"
                               name="fio"
                               placeholder="Введите ваше ФИО"
                               required>
                        @error('fio')
                        <div class="error-message">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Телефон:</label>
                        <input type="text"
                               name="phone"
                               placeholder="+7(XXX)-XXX-XX-XX"
                               required>
                        @error('phone')
                        <div class="error-message">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email"
                               name="email"
                               placeholder="Введите ваш email"
                               required>
                        @error('email')
                        <div class="error-message">{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    @endguest

    @auth
        <div class="user-welcome">
            <h1>Добро пожаловать!</h1>
            <p>Рады видеть вас снова в системе Грузовозофф. Теперь у вас есть доступ ко всем функциям нашей платформы.</p>
            <a href="/dashboard" class="btn-dashboard">Перейти в личный кабинет</a>
        </div>
    @endauth
</main>

<footer>
    <div class="footer-content">
        <p>&copy; 2024 Грузовозофф. Все права защищены.</p>
        <p>Платформа для эффективной логистики и грузоперевозок</p>
    </div>
</footer>
</body>
</html>
