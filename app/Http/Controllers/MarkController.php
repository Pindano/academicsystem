<?php

namespace App\Http\Controllers;

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
}
