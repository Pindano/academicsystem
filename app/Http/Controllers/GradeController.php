<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
            'grades.*' => 'required|numeric|min:0|max:100',
            'examination_id' => 'required|exists:examinations,id',
            'teacherId'=>'required|exists:teachers,id',
            'classId'=>'required|exists:darasas,id',
            'subjectId'=>'required|exists:subjects,id',
        ]);

        $examinationId = $validatedData['examination_id'];

        foreach ($validatedData['grades'] as $studentId => $grade) {
            Mark::updateOrCreate(
                [
                    'teacher_id' => $validatedData['teacherId'],
                    'class_id' => $validatedData['classId'],
                    'subject_id' => $validatedData['subjectId'],
                    'student_id' => $studentId,
                    'examination_id' => $examinationId,
                ],
                ['performance' => $grade]
            );
        }
        return response()->json(['message' => 'Grades successfully submitted.'], 200);
    }
}
