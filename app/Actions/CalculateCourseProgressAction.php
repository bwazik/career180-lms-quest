<?php

namespace App\Actions;

use App\Models\Course;
use App\Models\LessonProgress;
use App\Models\User;
use App\Models\Lesson;

final class CalculateCourseProgressAction
{
    public function __invoke(User $user, Course $course): float
    {
        $totalLessons = Lesson::where('course_id', $course->id)->count();

        if ($totalLessons === 0) {
            return 100.0;
        }

        $completedLessons = LessonProgress::where('user_id', $user->id)
            ->whereNotNull('completed_at')
            ->whereHas('lesson', fn ($q) =>
                $q->where('course_id', $course->id)
            )
            ->count();

        return round(($completedLessons / $totalLessons) * 100, 2);
    }
}
