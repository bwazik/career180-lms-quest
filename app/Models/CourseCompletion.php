<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CourseCompletion
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Course $course
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCompletion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCompletion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCompletion query()
 */
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

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
