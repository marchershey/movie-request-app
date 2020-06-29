<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function settings()
    {
        $user = User::find(Auth::user()->id);
        return view('dashboard.settings')->with('user', $user);
    }
}
