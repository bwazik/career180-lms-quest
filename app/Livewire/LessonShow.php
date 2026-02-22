<?php

namespace App\Livewire;

use App\Actions\CalculateCourseProgressAction;
use App\Actions\MarkLessonCompletedAction;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\View\View;

#[Layout('layouts.master')]
class LessonShow extends Component
{
    public $course;
    public $lesson;
    public $nextLesson;
    public $prevLesson;
    public $progressPercentage = 0;
    public $isCompleted = false;
    public $isEnrolled = false;
    public $allLessons;
    public array $completedLessonIds = [];
    public int $watchSeconds = 0;

    public function mount(Course $course, Lesson $lesson): void
    {
        $this->course = $course;
        $this->lesson = $lesson;

        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $this->isEnrolled = $user && $user->enrollments()->where('course_id', $course->id)->exists();

        if (!$lesson->is_free_preview && !$this->isEnrolled) {
            abort(403, 'You must enroll to view this lesson.');
        }

        if (Auth::check()) {
            $progress = LessonProgress::firstOrCreate(
                ['user_id' => Auth::id(), 'lesson_id' => $lesson->id],
                ['started_at' => now(), 'watch_seconds' => 0]
            );

            if (is_null($progress->started_at)) {
                $progress->update(['started_at' => now()]);
            }

            $this->watchSeconds = $progress->watch_seconds ?? 0;
        }

        $this->loadAllLessons();
        $this->loadProgress();
        $this->loadNavigation();
    }

    private function loadAllLessons(): void
    {
        $this->allLessons = Lesson::where('course_id', $this->course->id)
            ->orderBy('order')
            ->get();

        if (Auth::check()) {
            $this->completedLessonIds = LessonProgress::where('user_id', Auth::id())
                ->whereNotNull('completed_at')
                ->whereIn('lesson_id', $this->allLessons->pluck('id'))
                ->pluck('lesson_id')
                ->toArray();
        }
    }

    private function loadProgress(): void
    {
        if (Auth::check()) {
            $this->progressPercentage = app(CalculateCourseProgressAction::class)(Auth::user(), $this->course);

            $this->isCompleted = LessonProgress::where('user_id', Auth::id())
                ->where('lesson_id', $this->lesson->id)
                ->whereNotNull('completed_at')
                ->exists();
        }
    }

    private function loadNavigation(): void
    {
        $this->nextLesson = Lesson::where('course_id', $this->course->id)
            ->where('order', '>', $this->lesson->order)
            ->orderBy('order', 'asc')
            ->first();

        $this->prevLesson = Lesson::where('course_id', $this->course->id)
            ->where('order', '<', $this->lesson->order)
            ->orderBy('order', 'desc')
            ->first();
    }

    public function markAsCompleted(): void
    {
        if (!Auth::check()) {
            return;
        }

        app(MarkLessonCompletedAction::class)(Auth::user(), $this->lesson);

        session()->flash('message', 'Lesson marked as completed!');

        $canAccessNext = $this->nextLesson
            && ($this->isEnrolled || $this->nextLesson->is_free_preview);

        if ($canAccessNext) {
            $this->redirect(route('lesson.show', [$this->course->slug, $this->nextLesson->id]), navigate: true);
        } else {
            $this->isCompleted = true;
            $this->completedLessonIds[] = $this->lesson->id;
            $this->progressPercentage = app(CalculateCourseProgressAction::class)(Auth::user(), $this->course);
            $this->dispatch('progress-updated', progress: $this->progressPercentage);
        }
    }

    public function updateWatchSeconds(int $seconds): void
    {
        if (!Auth::check()) {
            return;
        }

        LessonProgress::where('user_id', Auth::id())
            ->where('lesson_id', $this->lesson->id)
            ->where('watch_seconds', '<', $seconds)
            ->update(['watch_seconds' => $seconds]);
    }

    public function render(): View
    {
        return view('livewire.lesson-show');
    }
}
