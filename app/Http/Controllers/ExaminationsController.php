<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use Illuminate\Http\Request;

class ExaminationsController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'examname' => 'required|string',
            'term'=>'required|string',

        ]);

        Examination::create([
            'name' => $request->examname,
            'term' => $request->term,
            'school_id'=>$request->school_id,
        ]);

        return redirect()->back()->with('success', 'Examination created successfully.');
    }
}
