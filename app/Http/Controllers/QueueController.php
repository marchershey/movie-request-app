<?php

namespace App\Http\Controllers;

use App\Queue;
use App\User;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $queues = Queue::orderByDesc('votes')->orderBy('id')->paginate(8);

        // return User::find(1)->name;
        // return $movies;
        return view('queue')->with('queues', $queues);
    }
}
