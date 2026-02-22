<?php

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\LessonProgress;
use App\Models\CourseCompletion;
use App\Actions\EnrollUserAction;
use App\Mail\CourseCompletionEmail;
use Illuminate\Support\Facades\Mail;
use App\Actions\MarkLessonCompletedAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('enforces enrollment logic (no drafts, idempotent)', function () {
    // Draft course enrollment failure
    $draftCourse = Course::factory()->create(['is_published' => false]);
    $user = User::factory()->create();

    try {
        app(EnrollUserAction::class)($user, $draftCourse);
        $this->fail('Should not allow enrollment in draft course');
    } catch (Exception $e) {
        expect($e->getMessage())->toBe('Cannot enroll in an unpublished course.');
    }

    // Published course enrollment success
    $publishedCourse = Course::factory()->create(['is_published' => true]);
    $enrollment = app(EnrollUserAction::class)($user, $publishedCourse);

    expect($enrollment)->toBeInstanceOf(Enrollment::class)
        ->and(Enrollment::count())->toBe(1);

    // Idempotency check
    $enrollment2 = app(EnrollUserAction::class)($user, $publishedCourse);

    expect(Enrollment::count())->toBe(1)
        ->and($enrollment2->id)->toBe($enrollment->id);
});

it('updates lesson_progress when a lesson is completed', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create(['is_published' => true]);
    $lesson = Lesson::factory()->create(['course_id' => $course->id]);
    
    app(EnrollUserAction::class)($user, $course);

    app(MarkLessonCompletedAction::class)($user, $lesson);

    $progress = LessonProgress::where('user_id', $user->id)
        ->where('lesson_id', $lesson->id)
        ->first();

    expect($progress)->not->toBeNull()
        ->and($progress->completed_at)->not->toBeNull();
});

it('handles concurrent/duplicate completion attempts gracefully (Idempotency)', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create(['is_published' => true]);
    $lesson = Lesson::factory()->create(['course_id' => $course->id]);
    
    app(EnrollUserAction::class)($user, $course);

    // First completion
    app(MarkLessonCompletedAction::class)($user, $lesson);
    
    // Second completion (duplicate attempt)
    app(MarkLessonCompletedAction::class)($user, $lesson);

    $count = LessonProgress::where('user_id', $user->id)
        ->where('lesson_id', $lesson->id)
        ->count();

    expect($count)->toBe(1);
});

it('creates course_completions and queues Completion Email exactly once upon finishing the last lesson', function () {
    Mail::fake();

    $user = User::factory()->create();
    $course = Course::factory()->create(['is_published' => true]);
    $lesson1 = Lesson::factory()->create(['course_id' => $course->id, 'order' => 1]);
    $lesson2 = Lesson::factory()->create(['course_id' => $course->id, 'order' => 2]);
    
    app(EnrollUserAction::class)($user, $course);

    // Complete lesson 1
    app(MarkLessonCompletedAction::class)($user, $lesson1);
    
    expect(CourseCompletion::where('user_id', $user->id)->exists())->toBeFalse();
    Mail::assertNothingQueued();

    // Complete lesson 2 (Last lesson)
    app(MarkLessonCompletedAction::class)($user, $lesson2);

    expect(CourseCompletion::where('user_id', $user->id)->exists())->toBeTrue();
    
    Mail::assertQueued(CourseCompletionEmail::class, function ($mail) use ($user, $course) {
        return $mail->hasTo($user->email) && $mail->course->id === $course->id;
    });

    // Attempt to complete lesson 2 again
    Mail::fake(); // Reset mail fake
    app(MarkLessonCompletedAction::class)($user, $lesson2);

    Mail::assertNothingQueued();
});

it('respects database constraints for unique slugs with soft deletes', function () {
    // Create first course
    $course1 = Course::factory()->create(['title' => 'Laravel 101']);
    
    // Verify slug generation
    expect($course1->slug)->toBe('laravel-101');

    // Soft delete it (this should trigger our model event to rename the slug)
    $course1->delete();
    
    // Verify deleted state
    expect($course1->fresh()->deleted_at)->not->toBeNull();
    // Verify slug has been modified (contains deleted marker)
    expect($course1->fresh()->slug)->toContain('::deleted::');

    // Create second course with same title
    $course2 = Course::factory()->create(['title' => 'Laravel 101']);
    
    // Assert it created successfully and has the clean slug
    expect($course2->exists)->toBeTrue()
        ->and($course2->slug)->toBe('laravel-101')
        ->and($course2->id)->not->toBe($course1->id);
});
