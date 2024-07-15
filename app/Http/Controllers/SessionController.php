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
}
