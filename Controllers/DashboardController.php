<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::User();
        if ($user->usertype === 'super_admin') {
            return view('dashboard-super-admin');
        } elseif ($user->usertype === 'admin') {
            return view('dashboard-admin');
        } elseif ($user->usertype === 'artist') {
            return view('dashboard-artist');
        } else {
            return view('dashboard-user');
        }
    }
   
        public function profile(){   
        $user = Auth::User();
        $profile_edit =null;
        if ($user->usertype === 'admin') {
            return view('profile-admin', compact('user' ,'profile_edit'));
        } elseif ($user->usertype === 'artist') {
            return view('profile-artist', compact('user' ,'profile_edit'));
        } else {
            return view('profile-user', compact('user','profile_edit'));
        }
    }

    
    public function profile_edit($id){

        $profile_edit = User::findOrFail($id);
        $user = Auth::User();
        if ($user->usertype === 'admin') {
            return view('profile-admin', compact('profile_edit' ,'user'));
        } elseif ($user->usertype === 'artist') {
            return view('profile-artist', compact('profile_edit','user'));
        } else {
            return view('profile-user', compact('profile_edit','user'));
        }
    }
    
    public function profile_update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        $user->save();
         return redirect()->route('profile');
        
    }

    public function profile_destroy($id){
        $profile_destroy = User::find($id);
        $profile_destroy->delete();
        return redirect()->route('profile');
    }
}
