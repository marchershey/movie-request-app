<?php

namespace App\Http\Controllers;

use App\Radarr;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function searchMovies(Request $request)
    {
        $radarr = new Radarr;
        $movies = $radarr->searchTrakt('term', $request->movie);
        return $movies;
    }
}
