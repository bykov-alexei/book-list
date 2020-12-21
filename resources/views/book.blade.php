@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1>Add a new book</h1>
                </div>
                <div class="card-body">
                    <form action="/book" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <p>Book title</p>
                            </div>
                            <div class="col d-flex flex-column">
                                <input name="title" value="{{ session('title', '') }}">
                                @error('title')
                                    <span class="alert-danger" style="font-size: 1rem">{{ $message }} </span>   
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Note</p>
                            </div>
                            <div class="col d-flex flex-column">
                                <input name="note" value="{{ session('note', '') }}">
                                @error('note')
                                    <span class="alert-danger" style="font-size: 1rem">{{ $message }} </span>   
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Author</p>
                            </div>
                            <div class="col d-flex flex-column">
                                <input name="author" value="{{ session('author', '') }}">
                                @error('author')
                                    <span class="alert-danger" style="font-size: 1rem">{{ $message }} </span>   
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Tags</p>
                            </div>
                            <div class="col d-flex flex-column">
                                <input name="tags" placeholder="Place space between tags" value="{{ session('tags', '') }}">
                                @error('tags')
                                    <span class="alert-danger" style="font-size: 1rem">{{ $message }} </span>           
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-warning">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection