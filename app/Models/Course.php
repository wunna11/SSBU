<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable= [
        'title',
        'outlie',
        'image',
        'teacher_id',
        'rank',
        'public',
        'endtest_status'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class, 'course_id');
    }

}
