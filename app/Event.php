<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function addEvent($userid, $tmdbid, $title)
    {
        $event = new $this;
        $event->user_id = $userid;
        $event->tmdbid = $tmdbid;
        $event->title = $title;
        $event->save();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
