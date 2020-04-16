<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function searchSubmit(Request $request)
    {
        return $request;
    }
}

// search tmdb and get movie results
// search radarr and see if it exists
//      it does exist
//          return false
//      it does not exist
//          add movie


// title (string)
// qualityProfileId (int)
// titleSlug (string)
// images (array)
// tmdbId (int)
// profileId (int)
// year (int) release year. Very important needed for the correct path!
// path (string) - full path to the movie on disk or rootFolderPath (string) - full path will be created by combining the rootFolderPath with the movie title
// Optional:

// monitored (bool) - whether the movie should be monitored or not.
// addOptions (object) - should contain a searchForMovie (string) key with a bool value whether Radarr should search for the movie upon being added. For example:
// "addOptions" : {
//   "searchForMovie" : true
// }
