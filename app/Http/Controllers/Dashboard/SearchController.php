<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Tmdb;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchMovies(Request $request)
    {
        return (new Tmdb)->searchMovies($request['term']);
    }
}
