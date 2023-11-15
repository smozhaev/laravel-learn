@extends('layout')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">дата</th>
            <th scope="col">название</th>
            <th scope="col">краткое описание</th>
            <th scope="col">описание</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
        <tr>
            <th scope="row">{{$article['datePublic']}}</th>
            <td>{{$article['title']}}</td>
            <td>{{$article['shortDesc']}}</td>
            <td>{{$article['desc']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection