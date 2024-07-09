<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Darasa extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class_teacher')->withPivot('school_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher')->withPivot('teacher_id', 'school_id');
    }
}
