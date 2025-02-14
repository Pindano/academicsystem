<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index(Request $request){
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('teacher')->attempt($attributes)) {
            return redirect('/teacher');
        }

        if (Auth::guard('parent')->attempt($attributes)){
            return redirect('/parent');
        }
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'These credentials do not match our records.']);



    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // or use 'teacher' or 'parent' guard if applicable

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You are logged out!!.');
    }
}
