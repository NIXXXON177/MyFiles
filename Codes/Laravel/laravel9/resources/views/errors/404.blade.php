@extends ('layouts.layout', ['title' => "404 ошибка. Вы попали не туда"])

@section('content')
    <div class="card">
        <h2 class="card-header">Ты зашёл не туда, шальной (404 ошибка)</h2>
        <img src="{{ asset('img/maks.jpg') }}" alt="" class="maks">
    </div>

    <a href="/" class="btn btn-outline-primary">Срочно на главную страницу</a>
@endsection
