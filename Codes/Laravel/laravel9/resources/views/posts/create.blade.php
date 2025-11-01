@extends('layouts.layout')

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
      @csrf
      <h2>Создать пост</h2>
      <div class="form-group">
        <input type="text" name="title" id="title" class="form-control" placeholder="Заголовок">
      </div>
      <div class="form-group">
        <textarea name="descr" class="form-control" rows="3" placeholder="Описание"></textarea>
      </div>
      <div class="form-group">
        <input type="file" name="image" id="image" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
