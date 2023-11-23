@extends('layout')
@section('content')

<form action="/article" method="post">
    @csrf
    <div class="form-group">
        <label for="exampleInputPassword1">Дата Публикации</label>
        <input name="datePublic" type="date" class="form-control" id="">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Заголовок</label>
        <input name="title" type="text" class="form-control" id="">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Краткое содержание</label>
        <input name="shortDesc" type="text" class="form-control" id="" placeholder="введите краткое содержание">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Содержание</label>
        <input name="desc" class="form-control" id="exampleInputPassword1" placeholder="Содержание">
    </div>
    <div class="mb-3">
        <input type="hidden" name="article_id" value="{{$currentUserId}}">
    </div>
    <button type="submit" class="btn btn-primary">Отправить Статью</button>
</form>
@endsection