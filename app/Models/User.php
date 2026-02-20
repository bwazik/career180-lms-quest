<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function enrollments(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments')
            ->using(Enrollment::class)
            ->withPivot('enrolled_at')
            ->withTimestamps();
    }

    public function courseCompletions(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_completions')
            ->using(CourseCompletion::class)
            ->withPivot('completed_at')
            ->withTimestamps();
    }

    public function lessonProgress(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'lesson_progress')
            ->using(LessonProgress::class)
            ->withPivot(['started_at', 'completed_at', 'watch_seconds'])
            ->withTimestamps();
    }
}
