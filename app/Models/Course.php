<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'outlie',
        'image',
        'teacher_id',
        'rank',
        'public',
        'endtest_status'
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class, 'course_id');
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    // public function batches(): HasMany
    // {
    //     return $this->hasMany(Batch::class);
    // }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

}
