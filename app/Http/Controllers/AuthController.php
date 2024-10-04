<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register()  {
        return view("Auth.register");
    }
    public function create()  {
        return view("Auth.login");
    }
    public function admin1()  {
        $users=User::all();
        return view("admin.home",compact("users"));
    }
    public function login(Request $request)  {
        $data=$request->validate([
            "email"=>"required|email",
            "password"=>"required|string|min:5",
        ]);
        //check and login
       $is_auth= Auth::attempt(["email"=>$data['email'],"password"=>$data["password"]]);
        // check
        if (!$is_auth) {
            return redirect(url("/"))->withErrors("Credintails not correct");

        }
            return  redirect(url("admin1"));

    }
    public function store(Request $request)  {
       $data=$request->validate([
        "name"=>"required|max:255|string",
        "email"=>"required|email",
        "phone"=>"required|max:255|string",
        "password"=>"required|string",
       ]);
       $data['password']=bcrypt($data['password']);
       User::create($data);
       return redirect(url(""));
    }
    public function logout()  {
       Auth::logout();
       return redirect(url(""));

    }

}
