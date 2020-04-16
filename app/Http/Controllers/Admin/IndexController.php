<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Movie;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $missing = Movie::showMissingMovies()->paginate(6);
        return view('admin.index')->with('missing', $missing);
    }
}
