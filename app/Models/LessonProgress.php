<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LessonProgress extends Pivot
{
    protected $table = 'lesson_progress';
    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'started_at',
        'completed_at',
        'watch_seconds',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'watch_seconds' => 'integer',
    ];
}
