<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;
    protected $fillable = ['name', 'email', 'phonenumber','password'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_parent_class_school', 'parent_id', 'student_id')
            ->withPivot('darasas_id', 'school_id');
    }
}
