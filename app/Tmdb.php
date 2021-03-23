<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Tmdb extends Model
{
    public function __construct()
    {
        $this->url = env('TMDB_URL') . '/' . env('TMDB_VERSION') . '/';
        $this->key = env('TMDB_APIKEY');
    }

    public function searchMovies($term)
    {
        $request = [
            'type' => 'get',
            'endpoint' => 'search/movie',
            'params' => [
                'query' => $term,
            ],
        ];

        return $this->_request($request);
    }

    protected function _request(array $request)
    {

        if ($request['type'] == 'get') {
            $params = (!isset($request['params'])) ? '' : http_build_query($request['params']);
            $url = $this->url . $request['endpoint'] . '?' . $params . '&api_key=' . $this->key;
            return Http::get($url)->json();
        }

        // if ($request['type'] == 'post') {
        //     $url = $this->url . '/api/' . $request['endpoint'];

        //     return Http::withHeaders([
        //         'X-Api-Key' => $this->apiKey
        //     ])->post($url, $request['params']);
        // }

        // if ($request['type'] == 'post') {
        //     $url = $this->url . '/api/' . $request['endpoint'];

        //     return Http::withHeaders([
        //         'X-Api-Key' => $this->apiKey,
        //     ])->post($url, $request['params'])->json();
        // }

        // if ($params['type'] == 'put') {
        //     $url = $this->url . '/api/' . $params['endPoint'];
        //     $options['json'] = $params['data'];

        //     return $client->put($url, $options);
        // }

        // if ($params['type'] == 'delete') {
        //     $url = $this->url . '/api/' . $params['endPoint'] . '?' . http_build_query($params['data']);

        //     return $client->delete($url, $options);
        // }
    }
}
