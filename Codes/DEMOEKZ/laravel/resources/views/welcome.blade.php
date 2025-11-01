<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Learning</title>
</head>
<body>
<header>
    <a href="/login">Login</a>
    <a href="/">Главная</a>
    @auth()
        @if(Auth::user()->isAdmin())
            <br>
            <div>Добро пожаловать администратор</div>
            <a href="/admin">Админ панель</a>
        @endif
    @endauth
</header>

@guest
    <h1>Registration</h1>
    <form method="POST">
        @csrf
        <label for="login">Login: </label>
        <input type="text" name="login" placeholder="login" required>
        @error('login')
        <div>{{$message}}</div>
        @enderror

        <label for="password">Password: </label>
        <input type="password" name="password" placeholder="password" required>
        @error('password')
        <div>{{$message}}</div>
        @enderror

        <label for="fio">FIO: </label>
        <input type="text" name="fio" placeholder="fio" required>
        @error('fio')
        <div>{{$message}}</div>
        @enderror

        <label for="phone">Phone: </label>
        <input type="text" name="phone" placeholder="phone +7(XXX)-XXX-XX-XX" required>
        @error('phone')
        <div>{{$message}}</div>
        @enderror

        <label for="email">Email: </label>
        <input type="email" name="email" placeholder=email" required>
        @error('email')
        <div>{{$message}}</div>
        @enderror

        <button type="submit">Register</button>
    </form>
@endguest

@auth
    <h1>Привет авторизованный пользователь</h1>
    <form action="{{route('order.set')}}" method="POST">
        @csrf
        <input type="datetime-local" name="datetime">
        <input type="text" name="weight" placeholder="Вес груза">
        <input type="text" name="dimensions" placeholder="Габариты Xм-Xм-Xм">
        <input type="text" name="adr_o" placeholder="Адрес отправки">
        <input type="text" name="adr_d" placeholder="Адрес доставки">
        <select name="cargo_id">
            @foreach($cargos as $c)
                <option value="{{$c->id}}">{{ $c->name }}</option>
            @endforeach
        </select>
        <button type="submit">Отправить</button>
    </form>
@endauth

<footer>
{{--   Подвал сайта --}}
</footer>
</body>
</html>
