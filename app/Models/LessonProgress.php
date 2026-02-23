<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\LessonProgress
 *
 * @property int $id
 * @property int $user_id
 * @property int $lesson_id
 * @property \Illuminate\Support\Carbon|null $started_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property int $watch_seconds
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Lesson $lesson
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress query()
 */
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

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
