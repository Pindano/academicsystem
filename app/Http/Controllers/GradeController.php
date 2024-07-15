<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function getStudents(Teacher $teacher, Darasa $class, Subject $subject)
    {

        $students = $class->students;
        return response()->json([
            'students' => $students,
            'class' => $class,
            'subject' => $subject
        ]);
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'grades.*' => 'required|numeric|min:0|max:100', // Example validation rule for grades
            'examination_id' => 'required|exists:examinations,id' // Validate that examination_id exists
        ]);

        $examinationId = $validatedData['examination_id'];

        foreach ($validatedData['grades'] as $studentId => $grade) {
            Mark::updateOrCreate(
                [
                    'teacher_id' => $request->teacherId,
                    'class_id' => $request->classId,
                    'subject_id' => $request->subjectId,
                    'student_id' => $studentId,
                    'examination_id' => $examinationId, // Include the examination_id
                ],
                ['performance' => $grade]
            );
        }
        return redirect()->back()->with('message' , 'Grades successfully submitted.');
    }
}
