<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * The roles that belong to the user.
     */
    public function queues()
    {
        return $this->belongsTo('App\Queue', 'id');
    }
}
