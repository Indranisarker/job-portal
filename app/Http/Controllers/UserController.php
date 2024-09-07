<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

    //this method authenticate a user
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
         ]);

        if($validator -> passes()){
           if(Auth::attempt(['email'=> $request->email, 'password' => $request->password])){
            if(Auth::user()->role == 'admin'){
                return view('admin.dashboard');
            }
            else{
                return redirect()->route('home');
            }
                
           }
           if (Auth::check()) {
            $userId = Auth::user()->id;
        } 
           else{
            return redirect()-> route('user.showLoginForm')-> with('error', 'Invalid username or password');
           }

        }
        if($validator -> fails()){
            //redirect to login page with error
            return redirect()->route('user.showLoginForm')
            ->withErrors($validator)
            ->withInput($request->only('email'));  // hold email in form even if there occure any error.
        }
    }

    //this method show user profile details
    public function profile(){
        $id = Auth::user()->id; // fetch current user id
        // $user = User::where('id', $id)->first(); // fetch user information using that id
        $user = User::find($id);
            return view('frontend.user.profile',[
                'user' => $user
            ]);
    }

    //update profile informations
    public function updateProfile(Request $request){
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users,email,' . $id . ',id' //ignore current email address
        ]);
          if($validator->passes()){
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->designation = $request->designation;
            $user->phone_no = $request->mobile;
            $user -> save();
            session()->flash('success', 'Update Profile Successfully!');

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

    //update profile picture
    public function changeProfilePicture(Request $request){
        Log::debug($request->all()); 
        $validator = Validator::make($request->all(),[
              'image' => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);
        $id = Auth::user()->id;
        if($validator -> passes()){
            $image  = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id.'-'.time() . '.' . $ext;
            $image->move(public_path('/profile-images'), $imageName);

             //detele old or same images
            File::delete(public_path('/profile-images/'.Auth::user()->image));
            
            User::where('id', $id)->update(['image' => $imageName]);
            session()->flash('success', 'Update Profile Picture Successfully!');

           

            return response()->json([
                'status' => true, 
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

    //logout logic
     
   public function logout(Request $request)
   {
       Auth::logout();  // Log the user out

       $request->session()->invalidate();  // Invalidate the session

       $request->session()->regenerateToken();  // Regenerate the CSRF token

       return redirect('/');  // Redirect to the homepage
   }
}
