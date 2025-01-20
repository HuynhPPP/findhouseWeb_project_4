<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserDashboard()
    {
        return view('front.user.user_dashboard');
    }

    public function Index()
    {
        return view('front.index');
    }
}
