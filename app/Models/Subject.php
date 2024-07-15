<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    Protected $fillable = ['subjectname'];
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher')->withPivot('teacher_id','darasa_id', 'school_id');
    }
    public function darasas()
    {
        return $this->belongsToMany(Darasa::class, 'subject_teacher')
            ->withPivot('teacher_id', 'school_id');
    }
    public function examinations()
    {
        return $this->belongsTo(Examination::class);
    }
    public function getDarasaAttribute()
    {
        return Darasa::find($this->pivot->darasa_id);
    }
}
