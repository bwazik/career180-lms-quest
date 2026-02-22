<?php

namespace App\Livewire;

use App\Actions\CalculateCourseProgressAction;
use App\Models\CourseCompletion;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\View\View;

#[Layout('layouts.master')]
class StudentDashboard extends Component
{
    public function render(): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $enrolledCourses = $user->enrollments()
            ->with(['image', 'level', 'lessons' => fn($q) => $q->orderBy('order')])
            ->withCount('lessons')
            ->get();

        $progressAction = app(CalculateCourseProgressAction::class);

        $completedCourseIds = CourseCompletion::where('user_id', $user->id)
            ->pluck('course_id')
            ->toArray();

        $courses = $enrolledCourses->map(function ($course) use ($user, $progressAction, $completedCourseIds) {
            $course->progress = $progressAction($user, $course);
            $course->is_course_completed = in_array($course->id, $completedCourseIds);
            return $course;
        });

        $totalCompleted = $courses->where('is_course_completed', true)->count();
        $overallProgress = $courses->count() > 0
            ? round($courses->avg('progress'), 1)
            : 0;

        return view('livewire.student-dashboard', [
            'courses' => $courses,
            'totalCompleted' => $totalCompleted,
            'overallProgress' => $overallProgress,
        ]);
    }
}
