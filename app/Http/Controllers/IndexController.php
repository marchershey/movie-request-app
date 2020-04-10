<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Show the application's home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $movies = Movie::where('added', 1)->paginate(6);
        return view('index')->with('movies', $movies);
    }
}
