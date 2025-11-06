@extends('layouts.layout', ['title' => 'Главная страница'])

@section('content')
    @if(request('search'))
        @if($posts->count() > 0)
            <h2>Результаты поиска по запросу "<b>{{ request('search') }}</b>"</h2>
            <p class="lead">Всего найдено {{ $posts->count() }} поста(ов)</p>
        @else
            <h2>По запросу "<b><?=htmlspecialchars($_GET['search'])?></b>" ничего не найдено</h2>
            <a href="{{ route('post.index') }}" class="btn btn-primary">Отобразить все посты</a>
        @endif
    @endif
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-6">
            <div class="card">
                <div class="card-header"><h2>{{ $post->short_title }}</h2></div>
                <div class="card-body">
                    <div class="card-img" style="background-image: url('{{ $post->img ? asset("storage/img/" . $post->img) : asset("img/image.png") }}')"></div>
                    <div class="card-author">Автор: <b>{{ $post->author_name }}</b></div>
                    <a href="{{ route('post.show', ['post' => $post->post_id]) }}" class="btn btn-outline-primary">Посмотреть пост</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $posts->appends(request()->query())->links() }}
@endsection

