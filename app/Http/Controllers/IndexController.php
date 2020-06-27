<?php

namespace App\Http\Controllers;

use App\Event;
use App\Radarr;

class IndexController extends Controller
{
    /**
     * Show the application's home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $movies = collect((new Radarr)->getAllInstalledMovies())->sortByDesc('added');
        $count = count($movies);
        $events = Event::all()->sortByDesc('created_at')->paginate(10);
        return view('index')->with('movies', $movies->paginate(36))->with('count', $count)->with('events', $events);
    }
}
