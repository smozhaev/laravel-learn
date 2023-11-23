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
    <h3 class="mt-3">Comments</h3>
    <div class="alert-danger">
        @if ($errors->any())
        @foreach($errors->all() as $error)
        <ul>
            <li>{{$error}}</li>
        </ul>
        @endforeach
        @endif
    </div>
    <form action="/comment" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleInputTitle" name="title">
        </div>
        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Text</label>
            <input type="text" class="form-control" id="exampleInputText" name="text">
        </div>
        <div class="mb-3">
            <input type="hidden" name="article_id" value="{{$article->id}}">
        </div>
        <button type="submit" class="btn btn-primary">Add comment</button>
    </form>
    @foreach($comments as $comment)
    <div class="card mt-3" style="width: 50%;">
        <div class="card-body">
            <h5 class="card-title">{{$comment->title}}</h5>
            <p class="card-text">{{$comment->text}}</p>
            <div class="btn-group">
                <a href="/comment/edit/{{$comment->id}}" class="btn btn-primary mr-3">Update comment</a>
                <a href="/comment/delete/{{$comment->id}}" class="btn btn-primary mr-3">Delete comment</a>
            </div>
        </div>
    </div>
    @endforeach



    <!-- <p class="lead">
        <a class="btn btn-primary btn-lg" href="/article/{{$article->id}}" role="button">Удалить</a>
    </p> -->
</div>
@endsection