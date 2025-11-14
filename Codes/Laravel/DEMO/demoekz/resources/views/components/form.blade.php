@section('form')
<form action="POST">
    @csrf
    <label for="name">Имя</label>
    <input type="text" name="name">
</form>
@endsection
