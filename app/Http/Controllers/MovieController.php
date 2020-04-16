<?php

namespace App\Http\Controllers;

use App\Tmdb;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function searchTmdb(Request $request)
    {
        $tmdb = new Tmdb;
        $movies = $tmdb->request('search/movie', $request->movie);
        return $movies;
    }

    public function searchTmdbVideos(Request $request)
    {
        $tmdb = new Tmdb;
        $movies = $tmdb->request('movie/' . $request->tmdbid . '/videos');
        return $movies;
    }
}
