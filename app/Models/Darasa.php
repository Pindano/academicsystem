<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Darasa extends Model
{
    use HasFactory;
    protected $fillable = ['id','classname'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_parent_class_school', 'darasas_id', 'student_id')
            ->withPivot('darasas_id', 'student_id');
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'classteachers')->withPivot('school_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher')->withPivot('teacher_id', 'school_id');
    }
}
