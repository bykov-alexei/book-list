@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

        @foreach ($books as $book)
        <div class="alert alert-primary d-flex justify-content-between">
            <div>
                <p><a href="/book/{{$book->id}}">{{$book->title}} - ({{ $book->author }})</a></p>
                @if ($book->status == 'started')
                    <p>In progress</p>
                @elseif ($book->status == 'finished')
                    <p>Finished</p>
                @elseif ($book->status == 'deleted')
                    <p>Deleted</p>
                @endif
            </div>
            <div>
                @if ($book->status == 'postponed')
                <form action="/book/{{ $book->id }}/read" method="post">
                    @method('put')
                    @csrf
                    <button class="btn btn-success">Return to the list</button>
                </form>
                @endif
                <form action="/book/{{ $book->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger">Delete from history</button>
                </form>
            </div>
        </div>
        @endforeach

        </div>
    </div>
</div>
@endsection