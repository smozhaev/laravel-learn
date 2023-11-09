@extends('layout')
@section('content')

<form method="post" action="auth/login">
    @csrf
    <div class="form-group">
        <label for="exampleInputPassword1">Name</label>
        <input name="name" type="text" class="form-control" id="" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            placeholder="Enter email">

    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection