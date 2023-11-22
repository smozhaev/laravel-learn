@extends('layout')
@section('content')
<div class="jumbotron" style="margin-top: 60px;">
    <h1 class="display-4">{{$article->title}}</h1>
    <div style="display:flex; flex-direction:row; justify-content:space-between; margin: 20px 0px 20px 0px;">
        <p class="lead">{{$article->shortDesc}}</p>
        <a href="#" style="margin-right:clamp(0px,1vw,20px);">{{$authorName}}</a>
    </div>


    <p>{{$article->desc}}</p>
    <div class=" form-inline my-2 my-lg-0">
        <a class="btn btn-primary btn-lg" style="margin-right: 10px;"
            href="/article/{{$article->id}}/edit">Редактировать</a>
        <form class="lead" action="/article/{{$article->id}}" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-primary btn-lg" style="margin-right: 10px;" type="submit">Удалить</button>
        </form>

    </div>

    <!-- <p class="lead">
        <a class="btn btn-primary btn-lg" href="/article/{{$article->id}}" role="button">Удалить</a>
    </p> -->
</div>
@endsection