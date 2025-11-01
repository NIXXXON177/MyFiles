<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="/login">Login</a>
        <a href="/">Главная</a>
    </header>

    <div>
        @foreach($orders as $o)
            <div>
                <h3>ID: {{$o->id}}</h3>
                <p>Дата отправления: {{$o->datetime}}</p>
                <p>Вес груза: {{$o->weight}}</p>
                <p>Габариты груза: {{$o->dimensions}}</p>
                <p>Адрес отправки: {{$o->adr_o}}</p>
                <p>Адрес доставки: {{$o->adr_d}}</p>
                <p>Пользователь: {{$o->user->fio}}</p>
                <p>Номер пользователя: {{$o->user->phone}}</p>
                <p>Тип груза: {{$o->cargo->name}}</p>
                <p>Статус заявки: {{$o->status}}</p>
                @if($o->status == 'pending')
                    <form action="/admin/accepted/{{$o->id}}" method="POST">
                        @csrf
                        <button type="submit">Подтвердить</button>
                    </form>
                    <form action="/admin/declined/{{$o->id}}" method="POST">
                        @csrf
                        <button type="submit">Отклонить</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</body>
</html>
