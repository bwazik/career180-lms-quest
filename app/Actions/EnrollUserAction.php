<?php

namespace App\Actions;

use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Exception;
use Illuminate\Support\Facades\Log;

final class EnrollUserAction
{
    public function __invoke(User $user, Course $course): Enrollment
    {
        try {
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
        } catch (\Throwable $e) {
            Log::error('Error enrolling user in course', [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
