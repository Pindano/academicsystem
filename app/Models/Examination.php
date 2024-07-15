<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'term','school_id'];

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
    public function subject()
    {
        return $this->hasMany(Subject::class);
    }
}
