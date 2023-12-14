@extends('layout')
@section('content')
@foreach($comments as $comment)
<div class="card mt-3" style=" background-color: #e9ecef">
    <div class="card-body">
        <div class="d-flex flex-row justify-content-between">
            <p>{{$comment->updated_at}}</p>
        </div>

        <h6 class="card-title">{{$comment->title}}</h6>
        <p class="card-text">{{$comment->text}}</p>


        <form action="/moderate/approve/{{$comment->id}}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-outline-success">Одобрить</button>
        </form>

        <form action="/moderate/disapprove/{{$comment->id}}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-outline-danger">Отклонить</button>
        </form>

    </div>
</div>
</div>
@endforeach
{{ $comments->links() }}
@endsection