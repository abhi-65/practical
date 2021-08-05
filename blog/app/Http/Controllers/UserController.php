<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use DB;
use Auth;
use Hash;
use Session;

class UserController extends Controller
{
    public function login(Request $request)
    {
        return view('backend.login');
    }

    public function register(Request $request)
    {
        $roles = DB::table('role')->get();
        return view('backend.register',compact('roles'));
    }

    public function saveUser(RegisterRequest $registerRequest)
    {
        $user = new User();
        $user->first_name = $registerRequest->first_name;
        $user->last_name = $registerRequest->last_name;
        $user->email = $registerRequest->email;
        $user->password = Hash::make($registerRequest->password);
        $user->date_of_birth = date('Y-m-d',strtotime($registerRequest->date_of_birth));
        $user->role_id = $registerRequest->role;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        if($registerRequest->hasFile('image'))
        {
            $fileName = time().'.'.$registerRequest->image->extension();  
   
            $registerRequest->image->move(public_path('uploads'), $fileName);
            $user->image = $fileName;
            $user->save();
        }
        Auth::login($user);
        return redirect()->route('index');

    }

    public function authenticate(LoginRequest $loginRequest)
    {
        //dd($loginRequest->all());
        $checkUser = User::where('email',$loginRequest->email)->first();
        if(!empty($checkUser))
        {
            if(Hash::check($loginRequest->password,$checkUser->password))
            {
                Auth::login($checkUser);
                return redirect()->route('index');
            }
            else
            {
                Session::flash('message','Invalid Password');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('message','Invalid Email');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
