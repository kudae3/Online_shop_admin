<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
        // User list
        public function adminView(){
            $admins = User::when(request('search'), function($query){
                $query->where('role', 'admin')
                      ->where(function($query){
                            $query  ->orWhere('id',request('search'))
                            ->orWhere('name','like','%'.request('search').'%')
                            ->orWhere('email','like','%'.request('search').'%')
                            ->orWhere('phone','like','%'.request('search').'%')
                            ->orWhere('address','like','%'.request('search').'%');
                      });
            })
            ->where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
            return view('Admin.list', compact('admins'));
        }

        //switch to user
        public function switchUser(Request $req){
            User::where('id', $req->id)->update([
                'role' => 'user'
            ]);
            return redirect()->route('admin#list');
        }
}
