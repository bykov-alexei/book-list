@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>My books</h1>
                </div>
                <div class="card-body">
                    <h2>Books I started</h2>
                    @foreach ($started_books as $book)
                        <div class="alert alert-primary">
                            <div class="d-flex justify-content-between">
                                <p class="align-middle"><a href="book/{{$book->id}}">{{ $book->title }} - ({{ $book->author }})</a></p>
                                <div>
                                    <form class="d-inline-block" action="/book/{{ $book->id }}/finish" method="post">
                                        @csrf
                                        <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Click here to save a day you finished the book">Finish reading</button>
                                    </form>
                                    <form class="d-inline-block" action="/book/{{ $book->id }}/finish" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Click here if you have to stop reading a book. You can always continue without loosing time">Pause reading</button>    
                                    </form>
                                </div>
                            </div>
                            <div class="d-flex">
                            @foreach ($book->tags as $tag)
                                <p class="alert alert-warning m-1 p-1">{{ $tag->title }}</p>
                            @endforeach
                            </div>
                        </div>
                    @endforeach
                    <h2>Books I want to read</h2>
                    @foreach ($listed_books as $book)
                        <div class="alert alert-primary">
                            <div class="d-flex justify-content-between">
                                <p><a href="book/{{$book->id}}">{{ $book->title }} - ({{ $book->author }})</a></p>
                                <div>
                                    <form class="d-inline-block" action="/book/{{ $book->id }}/read" method="post">
                                        @csrf
                                        <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Click here to save a day you started the book">Start reading</button>
                                    </form>
                                    <form class="d-inline-block" action="/book/{{ $book->id }}/read" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Click here if you changed your mind about reading the book">I won't read</button>
                                    </form>
                                </div>
                            </div>
                            <div class="d-flex">
                            @foreach ($book->tags as $tag)
                                <p class="alert alert-warning m-1 p-1">{{ $tag->title }}</p>
                            @endforeach
                            </div>
                        </div>
                    @endforeach
                    <button class="btn btn-warning"><a href="/book">Add a book</a></button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h1>{{ Auth::user()-> name }}<h1>
                </div>

                <div class="card-body">
                    <p><strong>Member since:</strong> {{ Auth::user()->created_at->format('Y-m-d') }}</p>
                    <p><strong>Books you finished:</strong> {{ $finished_books }}</p>
                    <p><strong>Books you're reading:</strong> {{ count($started_books) }}</p>
                    <p><strong>Books you haven't started:</strong> {{ count($listed_books) }}</p>
                    <a href="book/all">Books I ever read</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
