<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Грузовозофф - login</title>
    <style>
        .error{
            border: 1px red solid;
        }
    </style>
</head>
<body>
    <form method="POST">
        @csrf
        <label for="login">Login:</label>
        <input type="text" name="login" placeholder="login" @error('login') class="error" @enderror required>
        @error('login')
            <div>{{$message}}</div>
        @enderror

        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="password" @error('password') class="error" @enderror required>
        @error('password')
            <div>{{$message}}</div>
        @enderror

        <button type="submit">Login</button>
    </form>
</body>
</html>
