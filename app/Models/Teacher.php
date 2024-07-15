<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;

    protected $fillable = ['school_id', 'first_name', 'last_name', 'email', 'phone_number', 'password','role'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Darasa::class, 'classteachers')->withPivot('school_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher')->withPivot('id','teacher_id','darasa_id', 'school_id');
    }

    public function isAdmin()
    {
        $adminRoles = ['Principal', 'Deputy Principal', 'Tech Admin'];

        return in_array($this->role, $adminRoles);
    }
    public function isClassTeacher()
    {
        $adminRoles = ['Class Teacher'];

        return in_array($this->role, $adminRoles);
    }
}
