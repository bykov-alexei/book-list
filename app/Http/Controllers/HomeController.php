<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listed_books = Auth::user()->books()->where('status', 'listed')->get();
        $started_books = Auth::user()->books()->where('status', 'started')->get();
        $finished_books = count(Auth::user()->books()->where('status', 'finished')->get());
        return view('home', compact([
            'listed_books', 
            'started_books',
            'finished_books']));
    }
}
