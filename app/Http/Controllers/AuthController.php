<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ImageService;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }    
    public function register()
    {
        return view('auth.register');
    }
    public function attempt(Request $request)
    {
        $creds = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        $remember = $request->boolean("remember");

        if (Auth::attempt($creds, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended("/dashboard");
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'regex:/^\+?[0-9\s\-]{7,20}$/'],
        ]);

        $user = User::create([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "password" => $request->input("password"),
            "phone" => $request->input("phone")
        ]);

        $user->assignRole('client');

        $user->profile_image = ImageService::generate($user->id, $user->name);
        $user->save();

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
