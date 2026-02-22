<?php

namespace App\Livewire;

use App\Actions\EnrollUserAction;
use App\Models\Course;
use App\Models\CourseCompletion;
use App\Models\LessonProgress;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\View\View;

#[Layout('layouts.master')]
class CourseShow extends Component
{
    public $course;
    public $isEnrolled = false;
    public $isCourseCompleted = false;
    public $resumeLesson = null;
    public $progressPercentage = 0;
    public array $completedLessonIds = [];

    public function mount(string $slug): void
    {
        $this->course = Course::where('slug', $slug)
            ->published()
            ->with(['level', 'image', 'lessons' => fn($query) => $query->orderBy('order')])
            ->firstOrFail();

        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            $this->isEnrolled = $user->enrollments()
                ->where('course_id', $this->course->id)
                ->exists();

            $completedIds = LessonProgress::where('user_id', $user->id)
                ->whereNotNull('completed_at')
                ->whereIn('lesson_id', $this->course->lessons->pluck('id'))
                ->pluck('lesson_id');

            $this->completedLessonIds = $completedIds->toArray();

            if ($this->isEnrolled) {
                $this->isCourseCompleted = CourseCompletion::where('user_id', $user->id)
                    ->where('course_id', $this->course->id)
                    ->exists();

                $this->resumeLesson = $this->course->lessons
                    ->whereNotIn('id', $completedIds)
                    ->first() ?? $this->course->lessons->first();

                $totalLessons = $this->course->lessons->count();
                $this->progressPercentage = $totalLessons > 0
                    ? round(($completedIds->count() / $totalLessons) * 100, 2)
                    : 100;
            }
        }
    }

    public function enroll(): void
    {
        if (!Auth::check()) {
            session()->put('url.intended', route('course.show', $this->course->slug));
            $this->redirect(route('login'));
            return;
        }

        app(EnrollUserAction::class)(Auth::user(), $this->course);

        $this->isEnrolled = true;

        session()->flash('message', 'Successfully enrolled in ' . $this->course->title);
    }

    public function render(): View
    {
        return view('livewire.course-show');
    }
}
