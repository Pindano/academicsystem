<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'school_name' => 'required|string|max:255',
            'school_location' => 'required|string|max:255',
            'school_phonenumber' => 'required|string|max:15',
            'first_name' => 'required|array',
            'first_name.*' => 'required|string|max:255',
            'last_name' => 'required|array',
            'last_name.*' => 'required|string|max:255',
            'email_address' => 'required|array',
            'email_address.*' => 'required|string|email|max:255',
            'phone_number' => 'required|array',
            'phone_number.*' => 'required|string|max:15',
            'role' => 'required|array',
            'role.*' => 'required|string|in:Principal,Deputy Principal,Tech admin',
        ]);

        // Create the school
        $school = School::create([
            'name' => $request->school_name,
            'location' => $request->school_location,
            'phone_number' => $request->school_phonenumber,
        ]);

        // Create staff members
        $staffMembers = [];
        $emailsAndPasswords = [];

        for ($i = 0; $i < count($request->first_name); $i++) {
            $password = Str::random(10);
            $hashedPassword = Hash::make($password);

            $teacher = new Teacher([
                'first_name' => $request->first_name[$i],
                'last_name' => $request->last_name[$i],
                'email_address' => $request->email_address[$i],
                'phone_number' => $request->phone_number[$i],
                'role' => $request->role[$i],
                'password' => $hashedPassword, // Store hashed password
            ]);

            $staffMembers[] = $teacher;

            // Collect email and password for sending emails later
            $emailsAndPasswords[] = [
                'email' => $request->email_address[$i],
                'password' => $password,
            ];
        }


        $school->teachers()->saveMany($staffMembers);

        foreach ($emailsAndPasswords as $credentials) {
            $this->sendCredentialsEmail($credentials['email'], $credentials['password']);
        }

        return redirect()->to('/admin/school')->with('success', 'School and staff information saved successfully.');
    }
    private function sendCredentialsEmail($email, $password)
    {

        \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\CredentialsMail($email, $password));
    }
}
