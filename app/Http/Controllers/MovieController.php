<?php

namespace App\Http\Controllers;

// use App\Movie;
// use App\Queue;
// use App\Vote;
use App\Event;
use App\Radarr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Return if the request button should display.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function button_request(Request $request)
    {
        $installedMovies = collect((new Radarr)->getAllInstalledMovies());
        $movie = collect($installedMovies->where('tmdbId', $request->tmdb_id))->collapse();

        if ($movie->isNotEmpty()) {
            if ($movie['downloaded']) {
                return 'downloaded';
            } else {
                return 'queue';
            }
        }

        return false;
    }

    /**
     * Runs the action of requesting a movie
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function action_request(Request $request)
    {
        // save the event
        // return $request;

        (new Event)->addEvent(Auth::user()->id, $request->tmdbId, $request->title);

        return $reponse = (new Radarr)->requestMovie($request->tmdbId);

    }

    // /**
    //  * Runs the action of requesting a movie
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function action_add(Request $request)
    // {
    //     $movie = Movie::find($request->movie_id);
    //     $movie->added = 1;
    //     if ($movie->save()) {
    //         $queue = Queue::where('movie_id', $movie->id);
    //         if ($queue->delete()) {
    //             return $movie->id;
    //         } else {
    //             return 'failed:queue';
    //         }
    //     } else {
    //         return 'failed:movie';
    //     }
    // }

    // /**
    //  * Runs the action of voting for a movie
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function action_vote(Request $request)
    // {
    //     if ($this->add_vote($request->movie_id, $request->queue_id)) {
    //         return 'success:vote';
    //     } else {
    //         return 'failed:vote';
    //     }
    // }

    // /**
    //  * Store a newly requested movie
    //  *
    //  * @param  array  $movie
    //  * @return string
    //  */
    // public function store_movie($data)
    // {
    //     $movie = new Movie;
    //     $movie->tmdb_id = $data->tmdb_id;
    //     $movie->title = $data->title;
    //     $movie->year = $data->year;
    //     $movie->desc = $data->desc;
    //     $movie->poster = $data->poster;
    //     $movie->trailer = $data->trailer;
    //     if ($movie->save()) {
    //         return $movie;
    //     }
    //     return false;
    // }

    // /**
    //  * Add a newly requested movie to the queue
    //  *
    //  * @param  array  $movie
    //  * @return boolean
    //  */
    // public function add_queue($movie_id, $tmdb_id)
    // {
    //     $queue = Queue::where('movie_id', $movie_id)->first();
    //     if (is_null($queue)) {
    //         $user_id = (Auth::check()) ? Auth::user()->id : 0;
    //         $queue = new Queue();
    //         $queue->movie_id = $movie_id;
    //         $queue->tmdb_id = $tmdb_id;
    //         $queue->user_id = $user_id;
    //         $queue->ip = request()->ip();
    //         if ($queue->save()) {
    //             $vote = new Vote();
    //             $vote->user_id = Auth::user()->id;
    //             $vote->movie_id = $movie_id;
    //             $vote->queue_id = $queue->id;
    //             if ($vote->save()) {
    //                 $return = 'success:queue';
    //             } else {
    //                 $return = 'failed:vote';
    //             }
    //         } else {
    //             $return = 'failed:queue';
    //         }
    //     }
    //     // need throwable error if queue exists for some odd reason
    //     return $return;
    // }

    // /**
    //  * Add a vote to a movie in the queue
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function add_vote($movie_id, $queue_id)
    // {
    //     $vote = new Vote();
    //     $vote->user_id = Auth::user()->id;
    //     $vote->movie_id = $movie_id;
    //     $vote->queue_id = $queue_id;
    //     if (!$vote->save()) {
    //         return false;
    //     }
    //     return true;
    // }

    // /**
    //  * Add a vote to a movie in the queue
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function get_votes(Request $request)
    // {
    //     $votes = Vote::where('movie_id', $request->movie_id)->get();
    //     $count = count($votes);
    //     return $count;
    // }

    // /**
    //  * Return if the request button should display.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function button_vote(Request $request)
    // {
    //     if (Auth::check()) {
    //         $movie = Movie::where('tmdb_id', $request->tmdb_id)->first();
    //         $vote = Vote::where([['movie_id', $movie->id], ['user_id', Auth::user()->id]])->first();
    //         if (!is_null($vote)) {
    //             return 'voted';
    //         }
    //     }
    //     return false;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
