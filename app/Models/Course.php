<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Course extends Model
{
    use SoftDeletes;

    protected static function booted(): void
    {
        static::saving(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    protected $fillable = [
        'level_id',
        'title',
        'slug',
        'description',
        'is_published',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->where('collection', 'image');
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function completions(): HasMany
    {
        return $this->hasMany(CourseCompletion::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->using(Enrollment::class)
            ->withPivot('enrolled_at')
            ->withTimestamps();
    }
}
