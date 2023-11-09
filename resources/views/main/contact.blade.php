@extends('layout')
@section('content')
<div class="jumbotron">
    <h1 class="display-4">Контакты</h1>
    <p class="lead">Пердоставляем Контакты наших пельменных</p>
    <hr class="my-4">
    <ul class="list-group">
        <li class="list-group-item">Name: {{$contact['name']}}</li>
        <li class="list-group-item">Adress: {{$contact['adres']}}</li>
        <li class="list-group-item">Phone: {{$contact['phone']}}</li>
        <li class="list-group-item">Email: {{$contact['email']}}</li>
        <li class="list-group-item"></li>
    </ul>
</div>
@endsection