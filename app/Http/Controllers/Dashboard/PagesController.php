<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index()
    {
        return view('sections.dashboard.index');
    }

    public function search()
    {
        return view('sections.dashboard.search');
    }

    public function settings()
    {
        $user = User::find(Auth::user()->id);
        return view('sections.dashboard.settings')->with('user', $user);
    }
}
