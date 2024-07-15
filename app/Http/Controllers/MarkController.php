<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'examination_id' => 'required|exists:examinations,id',
            'teacher_id' => 'required|exists:teachers,id',
            'student_ids' => 'required|array',
            'student_ids.*' => 'required|exists:students,id',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'required|exists:subjects,id',
            'class_ids' => 'required|array',
            'class_ids.*' => 'required|exists:darasas,id',
            'performances' => 'required|array',
            'performances.*' => 'required|integer|min:0|max:100',
        ]);

        foreach ($request->student_ids as $index => $student_id) {
            Mark::updateOrCreate(
                [
                    'examination_id' => $request->examination_id,
                    'student_id' => $student_id,
                    'subject_id' => $request->subject_ids[$index],
                    'class_id' => $request->class_ids[$index],
                    'teacher_id' => $request->teacher_id,
                ],
                ['performance' => $request->performances[$index]]
            );
        }

        return redirect()->back()->with('success', 'Marks assigned successfully.');
    }
    public function getPerformance($studentId)
    {
        $marks = Mark::where('student_id', $studentId)
            ->join('examinations', 'marks.examination_id', '=', 'examinations.id')
            ->join('subjects', 'marks.subject_id', '=', 'subjects.id')
            ->join('students', 'marks.student_id', '=', 'students.id')
            ->join('darasas', 'marks.class_id', '=', 'darasas.id')
            ->select(
                'examinations.name as exam_name',
                'examinations.term as term',
                'subjects.subjectname as subject_name',
                'marks.performance',
                'students.name as student_name',
                'darasas.classname as class_name'
            )
            ->get()
            ->map(function($mark) {
                $mark->grade = $this->calculateGrade($mark->performance);
                return $mark;
            });

        $averageGrade = $this->calculateAverageGrade($marks);

        return view('Parent.performance', [
            'marks' => $marks,
            'averageGrade' => $averageGrade,
        ]);
    }

    private function calculateGrade($score)
    {
        if ($score >= 90) {
            return 'A';
        } elseif ($score >= 80) {
            return 'A-';
        } elseif ($score >= 75) {
            return 'B+';
        } elseif ($score >= 70) {
            return 'B';
        } elseif ($score >= 65) {
            return 'B-';
        } elseif ($score >= 60) {
            return 'C+';
        } elseif ($score >= 55) {
            return 'C';
        } elseif ($score >= 50) {
            return 'C-';
        } elseif ($score >= 45) {
            return 'D+';
        } elseif ($score >= 40) {
            return 'D';
        } else {
            return 'E';
        }
    }

    private function calculateAverageGrade($marks)
    {
        if ($marks->isEmpty()) {
            return null;
        }

        $totalScore = $marks->sum('performance');
        $averageScore = $totalScore / $marks->count();

        return $this->calculateGrade($averageScore);
    }

    public function getStudentExams($studentId)
    {
        $exams = Mark::where('student_id', $studentId)
            ->join('examinations', 'marks.examination_id', '=', 'examinations.id')
            ->join('darasas', 'marks.class_id', '=', 'darasas.id') // Assuming 'darasas' is the table for classes
            ->select(
                'examinations.id as exam_id',
                'examinations.name as exam_name',
                'examinations.term as term',
                'darasas.classname as class_name'
            )
            ->distinct()
            ->get();

        return response()->json(['exams' => $exams]);
    }

}
