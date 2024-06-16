<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {

        return view("register.index", [
            "title" => "Register",
            "active" => "Register"
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|max:255",
            "username" => "required|unique:users|min:3|max:255",
            "email" => "required|email:dns|unique:users",
            "password" => "required|min:8|max:255"
        ]);

        $validatedData["password"] = Hash::make($validatedData["password"]);

        User::create($validatedData);
        return redirect()->route('login')->with('success','Successfull Register!!!');
    }
}
