@extends('layout')
@section('content')
<div class="jumbotron" style="margin-top: 60px;">
    <h1 class="display-4">{{ $users->role_id == 3 ? 'Автор' : 'Пользователь' }}
        {{$users->name}}
    </h1>
    <p class="lead">{{$users->author_desc}}</p>


    <div class=" form-inline my-2 my-lg-0">
        <!-- @can('update', $users) -->
        <a class="btn btn-primary btn-lg" style="margin-right: 10px;" href="/user/{{$user->id}}/edit">Редактировать
        </a>
        <!-- @endcan -->
    </div>

</div>
@endsection