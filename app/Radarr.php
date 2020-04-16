<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Radarr extends Model
{
    protected $server;
    protected $port;
    protected $key;

    public function __construct()
    {
        $this->server = env('RADARR_SERVER');
        $this->port = env('RADARR_PORT');
        $this->key = env('RADARR_APIKEY');
    }

    public function request($endpoint)
    {
        return 'http://' . $this->server . ':' . $this->port . '/api/' . $endpoint . '?apikey=' . $this->key;
    }
}
