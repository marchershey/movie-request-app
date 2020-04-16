<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tmdb extends Model
{
    public function __construct()
    {
        $this->url = env('TMDB_URL');
        $this->version = env('TMDB_VERSION');
        $this->key = env('TMDB_APIKEY');
    }

    public function request($endpoint, $query = '')
    {
        $url = $this->url . '/' . $this->version . '/' . $endpoint . "?api_key=" . $this->key . "&query=" . urlencode($query);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
}
