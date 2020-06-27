<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    public function getPoster($tmdbId)
    {
        if (!Storage::exists('public/' . $tmdbId)) {
            $movie = (new Radarr)->searchTrakt('tmdb', $tmdbId);
            $url = $movie['images'][0]['url'];

            $image = file_get_contents($url);
            $ext = substr($url, strrpos($url, '.') + 1);
            Storage::put('public/' . $tmdbId, $image);
            return Storage::url('public/' . $tmdbId);
        } else {
            return Storage::url('public/' . $tmdbId);
        }
    }
}
