<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('admin.home.login');
    }

    public function loginproses(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return \redirect('admin/home');
        }

        return \redirect('admin/login');
    }

    public function register(){
        return view('admin.home.register');
    }

    public function registeruseradmin(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);
        //  dd($user);
        return \redirect('admin/login');
    }

    public function logout(){
        Auth::logout();
        return \redirect('admin/login');
    }
}
