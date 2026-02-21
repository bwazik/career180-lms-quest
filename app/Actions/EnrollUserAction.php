<?php

namespace App\Actions;

use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Exception;

final class EnrollUserAction
{
    public function __invoke(User $user, Course $course): Enrollment
    {
        if (! $course->is_published) {
            throw new Exception("Cannot enroll in an unpublished course.");
        }

        return Enrollment::firstOrCreate(
            [
                'user_id' => $user->id,
                'course_id' => $course->id,
            ],
            [
                'enrolled_at' => now(),
            ]
        );
    }
}
