<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // User list
    public function userView(){
        $users = User::when(request('search'), function($query){
            $query->where('role', 'user')
                  ->where(function($query){
                        $query  ->orWhere('id',request('search'))
                        ->orWhere('name','like','%'.request('search').'%')
                        ->orWhere('email','like','%'.request('search').'%')
                        ->orWhere('phone','like','%'.request('search').'%')
                        ->orWhere('address','like','%'.request('search').'%');
                  });
        })
        ->where('role', 'user')
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        return view('User.list', compact('users'));
    }

    //switch tos admin
    public function switchAdmin(Request $req){
        User::where('id', $req->id)->update([
            'role' => 'admin'
        ]);
        return redirect()->route('user#list');
    }
}
