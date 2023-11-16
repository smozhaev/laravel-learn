@extends('layout')
@section('content')

<form action="/article/{{$article->id}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleInputPassword1">Дата Публикации</label>
        <input name="datePublic" type="date" class="form-control" id="" value="{{$article->datePublic}}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Заголовок</label>
        <input name="title" type="text" class="form-control" id="" value="{{$article->title}}">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Краткое содержание</label>
        <input name="shortDesc" type="text" class="form-control" id="" value="{{$article->shortDesc}}"
            placeholder="введите краткое содержание">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Содержание</label>
        <input name="desc" class="form-control" id="exampleInputPassword1" value="{{$article->desc}}"
            placeholder="Содержание">
    </div>
    <button type="submit" class="btn btn-primary">Отправить Статью</button>
</form>
@endsection