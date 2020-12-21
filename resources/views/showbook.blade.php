@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>{{ $book->title }}</h1>
                </div>

                <div class="card-body">
                    <p>{{ $book->note }}</p>
                    @if ($book->status == 'finished') 
                        @if ($time < 1)
                            <p>Time spent: less than one day </p>
                        @elseif ($time == 1)
                            <p>Time spent: 1 day</p>
                        @elseif ($time > 1)
                            <p>Time spent: {{ $time }} days</p>
                        @endif

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')