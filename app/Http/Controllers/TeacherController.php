<?php

namespace App\Http\Controllers;

use App\Models\Darasa;
use App\Models\School;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class TeacherController extends Controller
{
    public function assignClass(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'class_id' => 'required|exists:darasas,id',
        ]);

        $teacher = Teacher::find($request->teacher_id);
        $classId = $request->class_id;

        $teacher->role = 'Class Teacher';
        $teacher->save();

        $school_id = auth()->user()->school_id;
        $teacher->classes()->sync([$classId => ['school_id' => $school_id]]);

        return redirect()->back()->with('success', 'Class assigned successfully.');
    }
    public function unassignClass(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $teacher = Teacher::find($request->teacher_id);
        $teacher->classes()->detach();

        return redirect()->back()->with('success', 'Class unassigned successfully.');
    }
    public function assignSubjects(Request $request)
    {

        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'class_ids' => 'required|array',
            'class_ids.*' => 'exists:darasas,id',
        ]);

        $teacher = Teacher::find($request->teacher_id);
        $subjectId = $request->subject_id;
        $school_id = auth()->user()->school_id;


        // Attach the new subject-class relationships
        foreach ($request->class_ids as $classId) {
            $teacher->subjects()->attach($subjectId, [
                'darasa_id' => $classId,
                'school_id' => $school_id,
            ]);
        }

        return redirect()->back()->with('success', 'Subjects assigned successfully.');
    }
    public function unassignSubject(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $teacher = Teacher::find($request->teacher_id);
        $school_id = auth()->user()->school_id;


        DB::table('subject_teacher')->where('id', $request->pivot_id)->delete();

        return redirect()->back()->with('success', 'Subject unassigned successfully.');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|array',
            'first_name.*' => 'required|string|max:255',
            'last_name' => 'required|array',
            'last_name.*' => 'required|string|max:255',
            'email' => 'required|array',
            'email*' => 'required|string|email|max:255',
            'phone_number' => 'required|array',
            'phone_number.*' => 'required|string|max:15',

        ]);


        $school = School::find(auth()->user()->school_id);

        $staffMembers = [];
        $emailsAndPasswords = [];

        for ($i = 0; $i < count($request->first_name); $i++) {
            $password = Str::random(10);
            $hashedPassword = Hash::make($password);

            $teacher = new Teacher([
                'first_name' => $request->first_name[$i],
                'last_name' => $request->last_name[$i],
                'email' => $request->email[$i],
                'phone_number' => $request->phone_number[$i],
                'password' => $hashedPassword, // Store hashed password
            ]);

            $staffMembers[] = $teacher;

            // Collect email and password for sending emails later
            $emailsAndPasswords[] = [
                'email' => $request->email[$i],
                'password' => $password,
            ];
        }


        $school->teachers()->saveMany($staffMembers);

        foreach ($emailsAndPasswords as $credentials) {
            $this->sendCredentialsEmail($credentials['email'], $credentials['password']);
        }

        return redirect()->to('/teacher/teachers')->with('success', 'Teacher information saved successfully.');
    }
    private function sendCredentialsEmail($email, $password)
    {

        \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\CredentialsMail($email, $password));
    }
    public function subject(Request $request){

        $request->validate([
           'name'=>'required',
        ]);
        $school = School::find(auth()->user()->school_id);

        $subject = new Subject([
           'subjectname' => $request->name,

        ]);
        $school->subjects()->save($subject);

        return redirect()->to('/teacher/subjects')->with('success', 'Teacher information saved successfully.');

    }
    public function darasa(Request $request){

        $request->validate([
            'classname'=>'required',
        ]);
        $school = School::find(auth()->user()->school_id);

        $class = new Darasa([
            'classname' => $request->classname,

        ]);
        $school->darasas()->save($class);

        return redirect()->to('/teacher/class')->with('success', 'Teacher information saved successfully.');

    }
}
