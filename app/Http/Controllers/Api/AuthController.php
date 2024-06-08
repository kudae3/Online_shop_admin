<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    //login (with email and password)
    public function userLogin(Request $req){

        try {

            Validator::make($req->all(), [
                'email' => 'required',
                'password' => 'required'
            ])->validate();

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
                        'message' => 'Incorrect Password'
                    ], 401);
                }
            }

            else{
                return response()->json([
                    'message' => 'your credentials could not be verified!'
                ], 401);
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

            Validator::make($req->all(), [
                'email' => 'required|unique:users,email|email',
                'phone' => 'required|unique:users,phone'
            ])->validate();

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

    //get User data with Token
    public function getUser(Request $req) {

        try {

            $user = Auth::user();

            return response()->json([
                'user' => $user
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }

    }

    //get input data
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
