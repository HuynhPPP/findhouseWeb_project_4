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

    public function PosterStoreProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('front/upload/poster_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('front/upload/poster_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Cập nhật thành công',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
