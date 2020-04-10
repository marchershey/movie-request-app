<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    // /**
    //  * The table associated with the model.
    //  *
    //  * @var string
    //  */
    // protected $table = 'queue';

    /**
     * The movies that belong to the queue.
     */
    public function movies()
    {
        return $this->hasOne('App\Movie', 'id', 'movie_id');
    }

    /**
     * The votes that belong to the queue.
     */
    public function votes()
    {
        return $this->hasMany('App\Votes', 'vote_id', 'queue_id');
    }

    /**
     * Display the amount of movies in the queue in the navbar
     *
     * @return init
     */
    public static function queueAmt()
    {
        $queue = Queue::all();
        return count($queue);
    }
}
