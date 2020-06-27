<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Radarr extends Model
{
    public function __construct()
    {
        $this->url = rtrim(env('RADARR_SERVER'), '/\\') . ':' . env('RADARR_PORT');
        $this->apiKey = env('RADARR_APIKEY');
        $this->httpAuthUsername = env('RADARR_HTTPUSERNAME');
        $this->httpAuthPassword = env('RADARR_HTTPPASSWORD');
    }

    /**
     * Returns a list of all installed movies in a json format
     *
     * @return string json encoded list of all locally installed movies
     */
    public function getAllInstalledMovies($params = null)
    {
        $request = [
            'type' => 'get',
            'endpoint' => 'movie',
            'params' => $params,
        ];

        return $this->request($request);
    }

    public function getQueue()
    {
        $request = [
            'type' => 'get',
            'endpoint' => 'queue',
        ];

        return $this->request($request);
    }

    public function requestMovie($tmdbId)
    {
        $movie = $this->searchTrakt('tmdb', $tmdbId);

        // return $movie;

        $request = [
            'type' => 'post',
            'endpoint' => 'movie',
            'params' => [
                'title' => $movie['title'],
                'qualityProfileId' => env('RADARR_DEFAULT_QUALITY_ID'),
                'titleSlug' => $movie['titleSlug'],
                'images' => $movie['images'],
                'tmdbId' => $movie['tmdbId'],
                'profileId' => env('RADARR_DEFAULT_PROFILE_ID'),
                'year' => $movie['year'],
                'path' => env('RADARR_DEFAULT_PATH') . $movie['title'] . ' (' . $movie['year'] . ')',
                'monitored' => true,
                'addOptions' => [
                    'searchForMovie' => true,
                ],
            ],
        ];

        return $this->request($request);
    }

    /**
     * Process requests
     *
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function request(array $request)
    {

        if ($request['type'] == 'get') {
            $params = (!isset($request['params'])) ? '' : http_build_query($request['params']);
            $url = $this->url . '/api/' . $request['endpoint'] . '?' . $params;
            return Http::withHeaders([
                'X-Api-Key' => $this->apiKey,
            ])->get($url)->json();
        }

        // if ($request['type'] == 'post') {
        //     $url = $this->url . '/api/' . $request['endpoint'];

        //     return Http::withHeaders([
        //         'X-Api-Key' => $this->apiKey
        //     ])->post($url, $request['params']);
        // }

        if ($request['type'] == 'post') {
            $url = $this->url . '/api/' . $request['endpoint'];

            return Http::withHeaders([
                'X-Api-Key' => $this->apiKey,
            ])->post($url, $request['params'])->json();
        }

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

    //- -------

    public function addMovieToCollection($id)
    {
        $trakt = $this->searchTrakt('tmdb', $id);

        // Let's make sure Trakt found the movie
        if (isset($trakt['message'])) {
            // Trakt return an error.
            return [
                'status' => 'failed',
                'message' => $trakt['message'],
            ];
        }

        $request = [
            'type' => 'post',
            'endpoint' => 'movie',
            'params' => [
                'title' => $trakt['title'],
                'qualityProfileId' => 1,
                'titleSlug' => $trakt['titleSlug'],
                'images' => $trakt['images'],
                'tmdbId' => $trakt['tmdbId'],
                'profileId' => 1,
                'year' => $trakt['year'],
                'path' => 'D:\\Plex\\Movies\\' . preg_replace('/[\/\:*?"<>|]/', '', $trakt['title']) . ' (' . $trakt['year'] . ')',
                'monitored' => true,
                'addOptions' => [
                    'searchForMovie' => true,
                ],
            ],
        ];

        return [
            'status' => 'success',
            'data' => $this->request($request),
        ];
    }

    /**
     * Checks whether the movie exists in your local movie collection by searching the TMDB ID
     *
     * @param string $tmdbid The TMDB ID of the movie to check exists
     * @return boolean Returns true if the movie exists, false if it doesn't
     */
    public function doesMovieExistByTmdbId($tmdbid)
    {
        // Get all of the movies installed
        $localMovies = collect($this->getAllInstalledMovies());
        // Check if the
        return ($localMovies->contains('tmdbId', $tmdbid)) ? true : false;
    }

    /**
     * Search movies on Trackt
     *
     * @param string $searchBy Define what to search by - term (default) | tmdb | imdb
     * @param string $term (movie title) | tmdb id | imdb id
     *
     * @return string json encoded list of all locally installed movies
     */
    public function searchTrakt($searchBy = 'term', $term)
    {
        if ($searchBy == 'term') {
            $request = [
                'type' => 'get',
                'endpoint' => 'movie/lookup',
                'params' => [
                    'term' => $term,
                ],
            ];
        }

        if ($searchBy == 'tmdb') {
            $request = [
                'type' => 'get',
                'endpoint' => 'movie/lookup/tmdb',
                'params' => [
                    'tmdbId' => $term,
                ],
            ];
        }

        if ($searchBy == 'imdb') {
            $request = [
                'type' => 'get',
                'endpoint' => 'movie/lookup/imdb',
                'params' => [
                    'imdbId' => $term,
                ],
            ];
        }

        return $this->request($request);
    }

    /* --------------------------------------------------------------------------------------------- */

    // /**
    //  * Search Radarr
    //  *
    //  * @param string $searchTerm The query string used to search
    //  * @param string $endpoint The url endpoint to specify what to search
    //  * @return string
    //  */
    // public function searchTrakt($endpoint, $termType = null, $searchTerm = null)
    // {
    //     $request = [
    //         'endpoint' => $endpoint,
    //         'type' => 'get',
    //         'data' => [
    //             $termType => $searchTerm
    //         ]
    //     ];

    //     return $this->request($request);
    // }

    // /**
    //  * Return all the local movies which are added to Radarr
    //  *
    //  * @param string $searchTerm The query string used to search
    //  * @param string $endpoint The url endpoint to specify what to search
    //  * @return string
    //  */
    // public function getAllLocalMovies($endpoint, $termType = null, $searchTerm = null)
    // {
    //     $request = [
    //         'endpoint' => $endpoint,
    //         'type' => 'get',
    //         'data' => [
    //             $termType => $searchTerm
    //         ]
    //     ];

    //     return $this->request($request);
    // }
}
