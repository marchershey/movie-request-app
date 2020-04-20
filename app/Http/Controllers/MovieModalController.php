<?php

namespace App\Http\Controllers;

use App\Radarr;
use App\Tmdb;
use Illuminate\Http\Request;

class MovieModalController extends Controller
{


    /**
     * Performs the action to request a movie to be added. Accepts an ajax
     * request of the TMDB ID of the movie requested. Returns a boolean.
     *
     * @param Request $request
     * @return boolean
     **/
    public function request(Request $request)
    {
        // Validate tmdbid is there and numeric
        $data = $request->validate([
            'tmdbid' => 'required|numeric'
        ]);

        // Create instances
        $radarr = new Radarr;

        // Another validation check
        if ($radarr->doesMovieExistByTmdbId($data['tmdbid'])) {
            return [
                'status' => 'failed',
                'message' => 'This movie already exists in the system.'
            ];
        }

        return $radarr->addMovieToCollection($data['tmdbid']);
    }
}
