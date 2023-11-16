@extends('layout')
@section('content')
<div class="jumbotron">
    <h1 class="display-4">{{$article->title}}</h1>
    <p class="lead">{{$article->shortDesc}}</p>

    <p>{{$article->desc}}</p>

    <a class="btn btn-primary btn-lg" href="/article/{{$article->id}}/edit">Редактировать</a>
    <form class="lead" action="/article/{{$article->id}}" method="post">
        @method('DELETE')
        @csrf
        <button class="btn btn-primary btn-lg" type="submit">Удалить</button>
    </form>
    <!-- <p class="lead">
        <a class="btn btn-primary btn-lg" href="/article/{{$article->id}}" role="button">Удалить</a>
    </p> -->
</div>
@endsection