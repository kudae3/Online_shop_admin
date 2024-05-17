<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    //login (with email and password)
    public function userLogin(Request $req){

        try {

            $user = User::where('email', $req->email)->first();

            if($user){

                if(Hash::check($req->password, $user->password )){
                    return response()->json([
                        'user' => $user,
                        'token' => $user->createToken(time())->plainTextToken
                    ]);
                }

                else{
                    return response()->json([
                        'user' => null,
                        'token' => null
                    ]);
                }

            }
            else{
                return response()->json([
                    'user' => null,
                    'token' => null
                ]);
            }

        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ],500);

        }

    }

    // register
    public function userRegister(Request $req){
        try {

            $this->Validation($req);
            $data = $this->getData($req);

            User::create($data);

            $user = User::where('email', $req->email)->first();

            return response()->json([
                'user' => $user,
                'token' => $user->createToken(time())->plainTextToken
            ]);

        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);

        }
    }

    // register validation
    private function Validation($req){
        Validator::make($req->all(), [
            'name' => 'required|max:15',
            'email' => 'required|unique:users,email|email',
            'phone' => 'required|min:10|max:15',
            'address' => 'required|max:50',
            'password' => 'required|min:8|max:15'
        ])->validate();
    }

    //get data
    private function getData($req){
        return [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
            'password' => $req->password
        ];
    }
}
