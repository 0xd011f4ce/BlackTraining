<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function index()
    {
        return view("auth.signup");
    }

    public function store(Request $request)
    {
        // modify request
        $request->request->add([
            "name" => Str::slug($request->name)
        ]);

        $request->validate([
            "name" => "required|string|max:16|unique:users",
            "email" => "required|email|unique:users",
            "password" => "required|string|min:8"
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        // authenticate user
        auth()->attempt($request->only("email", "password"));

        return redirect()->route("home.index");
    }
}
