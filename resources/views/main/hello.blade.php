@extends('layout')
@section('content')
<div class="jumbotron">
    <h1 class="display-4">Всем привет!</h1>
    <p class="lead">Это очень классная лавравель платформа на которой вы сможете делиться своим мнением и отзывами.</p>
    <hr class="my-4">
    <p>Быстрее кликай сюда чтобы узнать больше о нас.</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="about" role="button">О нас</a>
    </p>
</div>
<table class="table">
    <thead>
        <tr>

            <th scope="col">дата</th>
            <th scope="col">имя</th>
            <th scope="col">краткое описание</th>
            <th scope="col">описание</th>
            <th scope="col">preview img</th>
            <!-- <th scope="col">full img</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
        <tr>
            <th scope="row">{{$article['date']}}</th>
            <td>{{$article['name']}}</td>
            <td>{{$article['shortDesc']}}</td>
            <td>{{$article['desc']}}</td>
            <td>
                <a href="/galery/{{$article['full_image']}}">
                    <img src="{{URL::asset('/images/'.$article['preview_image'])}}" height="100" width="auto" />
                </a>
            </td>
            <!-- <td><img src="{{URL::asset('/images/'.$article['full_image'])}}" height="150" width="auto" /></td> -->

        </tr>
        @endforeach
    </tbody>
</table>

@endsection