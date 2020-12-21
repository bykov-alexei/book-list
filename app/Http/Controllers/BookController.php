<?php

namespace App\Http\Controllers;

use App\Book;
use App\Tag;
use Auth;
use App\ReadingProcess;
use Illuminate\Http\Request;
use Carbon;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('book');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session([
            'title' => $request['title'],
            'note' => $request['note'],
            'author' => $request['author'],
            'tags' => $request['tags'],
        ]);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'note' => 'max:255',
            'author' => 'required|max:255',
        ]);
        $book = Book::firstOrNew([
            'title' => $request['title'],
            'note' => $request['note'],
            'author' => $request['author'],
            'user_id' => Auth::user()->id,
        ]);
        $tags = [];

        $got_tags = explode(' ', $request->tags);
        foreach ($got_tags as $tag) {
            $tag = Tag::firstOrNew([
                'title' => $tag
            ]);
            $tag->validate();
            $tags []= $tag;
        }
        $book->save();
        foreach ($tags as $tag) {
            $tag->save();
            $book->tags()->attach($tag->id);
        }

        session([
            'title' => '',
            'note' => '',
            'author' => '',
            'tags' => '',
        ]);

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $time = 0;
        foreach ($book->reading_processes as $process) {
            $started = Carbon\Carbon::parse($book->created_at);
            $finished = Carbon\Carbon::parse($book->finished_at);
            $time += ($finished->diffInMinutes($started));
        }
        $time /= 24 * 60;

        return view('showbook', compact('book', 'time'));
    }

    public function all() {
        $books = Auth::user()->books;
        return view('books', compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return back();
    }

    public function exclude(Book $book) {
        $book->status = 'postponed';
        $book->save();
        return back();
    }

    public function return_back(Book $book) {
        $book->status = 'listed';
        $book->save();
        return back();
    }

    public function start_reading(Book $book) {
        $book->status = 'started';
        $book->save();
        $reading_process = ReadingProcess::create([
            'book_id' => $book->id,
        ]);
        return back();
    }

    public function end_reading(Book $book) {
        $book->status = 'finished';
        $process = $book->reading_processes()->whereNull('finished_at')->first();
        if ($process) {
            $process->finished_at = Carbon\Carbon::now()->toDateTimeString();
            $process->save();
            $book->save();
            return back();
        } else {
            return redirect('home');
        }
    }

    public function pause_reading(Book $book) {
        $book->status = 'listed';
        $process = $book->reading_processes()->whereNull('finished_at')->first();
        if ($process) {
            $process->finished_at = Carbon\Carbon::now()->toDateTimeString();
            $process->save();
            $book->save();
            return back();
        } else {
            return redirect('home');
        }
    }
}
