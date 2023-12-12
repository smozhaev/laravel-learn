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
        @can('update', $article)
        <a class="btn btn-primary btn-lg" style="margin-right: 10px;"
            href="/article/{{$article->id}}/edit">Редактировать
        </a>
        @endcan
        @can('delete', $article)
        <form class="lead" action="/article/{{$article->id}}" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-primary btn-lg" style="margin-right: 10px;" type="submit">Удалить</button>
        </form>
        @endcan

    </div>
    <div style="
        margin-top: 50px;
        padding: 15px;
        width: 75%;
        border-radius: 20px;
        background-color: white;
    ">
        <h3 class="mt-3">Коментарии</h3>
        <div class="alert-danger">
            @if ($errors->any())
            @foreach($errors->all() as $error)
            <ul>
                <li>{{$error}}</li>
            </ul>
            @endforeach
            @endif
        </div>
        @foreach($comments as $comment)
        <div class="card mt-3" style=" background-color: #e9ecef">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h5><a href="#"> {{$comment->author->name}}</a></h5>
                    <p>{{$comment->updated_at}}</p>
                </div>

                <h6 class="card-title">{{$comment->title}}</h6>
                <p class="card-text">{{$comment->text}}</p>
                <div class="btn-group">
                    @can('update', $comment)
                    <a href="/comment/edit/{{$comment->id}}" class="btn btn-primary mr-3">Изменить коментарий</a>
                    @endcan
                    @can('delete', $comment)
                    <a href="/comment/delete/{{$comment->id}}" class="btn btn-primary mr-3">Удалить Коментарий</a>
                    @endcan

                </div>
            </div>
        </div>
        @endforeach
        <form action="/comment" method="POST" style="
            margin-top: 50px;
            padding: 15px;
            max-width: 900px;
            
            border-radius: 20px;
            background-color: #e9ecef;
        ">
            @csrf
            <h3>Добавте коментарий</h3>
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

    </div>


    <!-- <p class="lead">
        <a class="btn btn-primary btn-lg" href="/article/{{$article->id}}" role="button">Удалить</a>
    </p> -->
</div>
@endsection