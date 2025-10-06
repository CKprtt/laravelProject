<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManageAccountController extends Controller
{
    public function index(Request $request){   

        $usertype = $request->query('usertype'); //ดึงค่าตัวแปรจาก URL
        if ($usertype) {
            $user = User::where('usertype', $usertype)->get();
         } 
        else {
            $user = User::all(); 
        }
        return view('manageaccount', compact('user', 'usertype'));
            
        }
    
    public function edit($id){

        $user_edit = User::findOrFail($id);
        $user = User::all(); 
        return view('edit-user', compact('user', 'user_edit'));
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->usertype = $request->input('usertype');
        $user->save();

        return redirect()->route('ManageAccount');
    }

    public function destroy($id){
        $user_destroy = User::find($id);
        $user_destroy->delete();
        return redirect()->route('ManageAccount');
    }
}


