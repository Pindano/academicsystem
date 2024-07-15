<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ParentCredentialsMail;

class ParentController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'parent_name' => 'required|string',
            'parent_email' => 'required|email|unique:parents,email',
            'parent_phonenumber' => 'required|string',
            'teacher_id' => 'required|integer|exists:teachers,id',
            'admission' => 'required|array',
            'admission.*' => 'required|integer',
            'first_name' => 'required|array',
            'first_name.*' => 'required|string',
            'last_name' => 'required|array',
            'last_name.*' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            $password = Str::random(10);
            $hashedPassword = Hash::make($password);


            $teacher = Teacher::find($request->teacher_id);
            $school = $teacher->school;
            $darasa = $teacher->classes->first();


            $parent = Parents::create([
                'name' => $request->parent_name,
                'email' => $request->parent_email,
                'phonenumber' => $request->parent_phonenumber,
                'password' => $hashedPassword,
            ]);

            // Create students and pivot records
            $studentsData = [];
            for ($i = 0; $i < count($request->admission); $i++) {
                $student = Student::create([
                    'id' => $request->admission[$i],
                    'name' => $request->first_name[$i] . ' ' . $request->last_name[$i],
                ]);

                $studentsData[] = [
                    'student_id' => $student->id,
                    'parent_id' => $parent->id,
                    'darasas_id' => $darasa->id,
                    'school_id' => $school->id,

                ];
            }

            DB::table('student_parent_class_school')->insert($studentsData);
            Mail::to($parent->email)->send(new ParentCredentialsMail($parent, $password));
        });

        // Redirect or return response
        return redirect()->back()->with('success', 'Parent and students registered successfully.');
    }
}
