<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    // Profile View
    public function ProfileView(){
        return view('Account.profile');
    }

    // edit View
    public function EditBtn(){
        return view('Account.edit');
    }

    // save edit data
    public function SaveBtn(Request $req){
        $this->validationCheck($req);
        $data = $this->getData($req);

        if($req->hasFile('image')){

            if(Auth::user()->photo){

                //delete storage photo
                Storage::delete('public/'.Auth::user()->photo);

                //update
                $imageName = uniqid().'_'.$req->file('image')->getClientOriginalName();
                $req->file('image')->storeAs('public', $imageName);
                $data['photo'] = $imageName;
            }

            else{
                //update
                $imageName = uniqid().'_'.$req->file('image')->getClientOriginalName();
                $req->file('image')->storeAs('public', $imageName);
                $data['photo'] = $imageName;
            }

        }

        User::where('id', Auth::user()->id)->update($data);

        return redirect()->route('account#profile');

    }

    // change Pass View
    public function changePassword(){
        return view('Account.changePass');
    }

    // confirm Pass Btn
    public function confirmBtn(Request $req){

        //validation
        Validator::make($req->all(), [
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword'
        ])->validate();

        $currentPassword = Auth::user()->password;

        if(Hash::check($req->currentPassword, $currentPassword)){
            $newPassword = Hash::make($req->newPassword);
            User::where('id', Auth::user()->id)->update([
                'password' => $newPassword
            ]);
            Auth::logout();
            return redirect()->route('loginPage');
        }
        else{
            return redirect()->back()->with(['PassError' => 'Incorrect Password']);
        }

    }


    //Validation
    private function validationCheck($req){

        $rules = [
            'image' => 'mimes:png,jpg,jpeg',
            'name' => 'required|unique:products,name,'.$req->id,
            'email' => 'required',
            'phone' => 'required|max:20',
        ];

        Validator::make($req->all(), $rules)->validate();
    }

    //get data
    private function getData($req){
        return [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'gender' => $req->gender,
            'address' => $req->address
        ];
    }
}
