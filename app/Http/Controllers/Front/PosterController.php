<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    public function PosterDashboard()
    {
        return view('front.poster.poster_dashboard');
    }
}
