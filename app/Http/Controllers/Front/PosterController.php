<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    public function PosterDashboard()
    {
        return view('front.poster.index');
    }

    public function PosterProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('front.poster.poster_profile_view',compact('profileData'));
    }
}
