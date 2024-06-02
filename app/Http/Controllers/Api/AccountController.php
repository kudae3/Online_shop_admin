<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    //edit account
    public function editAccount(Request $req){

        try{

            $user = User::find($req->user_id);

            try{

                $data = [
                    'name' => $req->name,
                    'email' => $req->email,
                    'phone' => $req->phone,
                    'gender' => $req->gender,
                    'address' => $req->address
                ];

                if($req->hasFile('image')){

                    if($user->photo){

                        Storage::delete('public/'.$user->photo);

                        $imageName = uniqid().'_'.$req->file('image')->getClientOriginalName();
                        $req->file('image')->storeAs('public', $imageName);
                        $data['photo'] = $imageName;
                    }

                    else{
                        $imageName = uniqid().'_'.$req->file('image')->getClientOriginalName();
                        $req->file('image')->storeAs('public', $imageName);
                        $data['photo'] = $imageName;
                    }


                }

                $user->update($data);

                return response()->json([
                    'message' => 'Successfully updated'
                ], 200);
            }

            catch(Exception $e){
                return response()->json([
                    'message' => $e->getMessage()
                ], 401);
            }

        }

        catch(Exception $e){

            return response()->json([
                'message' => $e->getMessage()
            ], 500);

        }

    }

}
