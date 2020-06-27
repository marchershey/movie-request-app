<?php

namespace App\Http\Controllers;

use App\Radarr;

class QueueController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $queue = (new Radarr)->getQueue();
        return view('queue')->with('queue', $queue);
    }
}
