<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Movie extends Model
{

    public static function savePoster($id)
    {
        $radarr = new Radarr();
        $image = file_get_contents($radarr->request('MediaCover/' . $id . '/poster.jpg'));
        $name = Str::random(40);
        Storage::disk('posters')->put($name, $image);

        // check if the file exists
        if (Storage::disk('posters')->exists($name)) {
            return $name;
        }
        return false;
    }

    public static function showMissingMovies()
    {
        return Movie::getMissingMovies();
    }

    public static function getMissingMovies()
    {
        $radarr = new Radarr();
        $remoteIds = collect(json_decode(file_get_contents($radarr->request('movie'))));
        $movies = Movie::all()->pluck('radarr_id')->values();
        $missing = $remoteIds->filter(function ($item) use ($movies) {
            return !in_array($item->id, $movies->toArray());
        });

        return $missing;
    }

    public static function getRemoteMovies()
    {
        $radarr = new Radarr();
        return collect(json_decode(file_get_contents($radarr->request('movie'))));
    }
}
