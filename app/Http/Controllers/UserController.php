<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //this method render the registration form
    public function showRegistrationForm(){
        return view('frontend.user.registration');
    }
     //this method render the login form
     public function showLoginForm(){
        return view('frontend.user.login');
    }

    //this method save user information for registration
    public function processRegistration(Request $request){
        $validator = Validator::make($request->all(),[
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users,email',
           'password' => 'required|min:5',
           'confirm_password' => 'required|same:password',
           'phone_no'=>'required|string'
        ]);
        if($validator->passes()){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_no' => $request->phone_no,
            ]);
            $user -> save();
            session()->flash('success', 'Registerd Successfully!');

            return response()-> json([
                'status'=> true,
                'errors' => []
            ]);
        }
        else{
            return response()-> json([
                'status'=> false,
                'errors' => $validator->errors()
            ]);
        }
        
    }
}
