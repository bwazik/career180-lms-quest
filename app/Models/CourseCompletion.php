<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseCompletion extends Pivot
{
    protected $table = 'course_completions';
    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'course_id',
        'completed_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];
}
