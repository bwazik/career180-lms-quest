<?php

namespace App\Actions;

use App\Models\Lesson;
use App\Models\User;
use App\Models\LessonProgress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class MarkLessonCompletedAction
{
    public function __construct(
        private readonly CheckAndCompleteCourseAction $checkAndCompleteCourse
    ) {}

    public function __invoke(User $user, Lesson $lesson): void
    {
        try {
            DB::transaction(function () use ($user, $lesson) {
                $progress = LessonProgress::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'lesson_id' => $lesson->id,
                    ],
                    [
                        'started_at' => now(),
                        'watch_seconds' => 0,
                    ]
                );

                if (is_null($progress->completed_at)) {
                    $progress->update(['completed_at' => now()]);

                    ($this->checkAndCompleteCourse)($user, $lesson->course);
                }
            });
        } catch (\Throwable $e) {
            Log::error('Error marking lesson as completed', [
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
