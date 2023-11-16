@extends('layout')
@section('content')

<div class="alert-danger">
    @if ($errors->any())
    @foreach($errors->all() as $error)
    <ul>
        <li>{{$error}}</li>
    </ul>
    @endforeach
    @endif
</div>

<form action="/registr" method="POST">
    @csrf
    <div class="mb-3">
        <label for="exampleInputName" class="form-label">Имя</label>
        <input type="text" class="form-control" id="exampleInputName" name="name">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    </div>

    <button type="submit" class="btn btn-primary">Зарегестрироваться</button>
</form>
@endsection