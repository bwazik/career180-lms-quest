<?php

namespace App\Actions;

use App\Mail\CourseCompletionEmail;
use App\Models\Course;
use App\Models\CourseCompletion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

final class CheckAndCompleteCourseAction
{
    public function __construct(
        private readonly CalculateCourseProgressAction $calculateProgress
    ) {}

    public function __invoke(User $user, Course $course): void
    {
        $progress = ($this->calculateProgress)($user, $course);

        if ($progress < 100.0) {
            return;
        }

        DB::transaction(function () use ($user, $course) {
            $completion = CourseCompletion::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ],
                [
                    'completed_at' => now(),
                ]
            );

            if ($completion->wasRecentlyCreated) {
                Mail::to($user)->queue(new CourseCompletionEmail($user, $course));
            }
        });
    }
}
