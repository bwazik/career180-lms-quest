<?php

namespace App\Policies;

use App\Models\LessonProgress;
use App\Models\User;

class LessonProgressPolicy
{
    public function before(User $user): ?bool
    {
        if ($user->is_admin) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, LessonProgress $lessonProgress): bool
    {
        return $user->id === $lessonProgress->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, LessonProgress $lessonProgress): bool
    {
        return $user->id === $lessonProgress->user_id;
    }

    public function delete(User $user, LessonProgress $lessonProgress): bool
    {
        return $user->id === $lessonProgress->user_id;
    }

    public function restore(User $user, LessonProgress $lessonProgress): bool
    {
        return $user->id === $lessonProgress->user_id;
    }

    public function forceDelete(User $user, LessonProgress $lessonProgress): bool
    {
        return $user->id === $lessonProgress->user_id;
    }
}
