@extends('layouts.layout', ['title' => "Создать новый пост"])

@section('content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <h2>Создать пост</h2>
      @include('posts.parts.form')
      <input type="submit" value="Создать пост" class="btn btn-outline-success">
    </form>
@endsection
