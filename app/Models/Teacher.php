<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['school_id', 'first_name', 'last_name', 'email_address', 'phone_number', 'password','role'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Darasa::class, 'class_teacher')->withPivot('school_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher')->withPivot('darasa_id', 'school_id');
    }
}
