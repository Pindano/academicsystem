<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request){
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($attributes)) {
            return redirect('/admin');
        }
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'These credentials do not match our records.']);



        }
    public function store(){

        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',

        ]);
        $attributes['password'] = bcrypt($attributes['password']);


        $admin = Admin::create($attributes);
        auth('admin')->login($admin);
        session()->flash('success', 'Your account has been created');

        return redirect('/admin');
    }






}
