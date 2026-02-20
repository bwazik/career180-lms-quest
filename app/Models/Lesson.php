<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_id',
        'title',
        'video_url',
        'duration_seconds',
        'order',
        'is_free_preview',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $casts = [
        'is_free_preview' => 'boolean',
        'order' => 'integer',
        'duration_seconds' => 'integer',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
