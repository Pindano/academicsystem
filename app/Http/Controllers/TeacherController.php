<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function assignClassAndSubjects(Request $request, School $school, Darasa $darasa)
    {
        $teacherIds = $request->input('teacher_ids');
        $subjectIds = $request->input('subject_ids');

        // Assign class teachers
        $darasa->teachers()->syncWithPivotValues($teacherIds, ['school_id' => $school->id]);

        // Assign subjects to teachers for the specific class
        foreach ($subjectIds as $subjectId) {
            $darasa->subjects()->attach($subjectId, ['school_id' => $school->id]);
        }

        return redirect()->to('/teacher/teachers')->with('success', 'Teacher information saved successfully.');
    }
}
