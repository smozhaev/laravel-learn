@extends('layout')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">Имя</th>
            <th scope="col">Информация о пользователе</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td><a href="/user/{{$user->id}}">{{$user['name']}}</a></td>
            <td>{{$user['author_desc']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection