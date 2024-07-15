<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name'];
    public function parents()
    {
        return $this->belongsToMany(Parent::class, 'student_parent_class_school', 'student_id', 'parent_id');

    }
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
    public function darasas()
    {
        return $this->belongsToMany(Darasa::class, 'student_parent_class_school', 'student_id', 'darasas_id');
    }
}
