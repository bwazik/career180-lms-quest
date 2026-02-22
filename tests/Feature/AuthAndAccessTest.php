<?php

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Livewire\Volt\Volt;
use App\Mail\WelcomeEmail;
use App\Models\LessonProgress;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

it('queues a welcome email upon user registration', function () {
    Mail::fake();

    $userData = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    Volt::test('pages.auth.register')
        ->set('name', $userData['name'])
        ->set('email', $userData['email'])
        ->set('password', $userData['password'])
        ->set('password_confirmation', $userData['password_confirmation'])
        ->call('register')
        ->assertRedirect(route('dashboard', absolute: false));

    Mail::assertQueued(WelcomeEmail::class, function ($mail) use ($userData) {
        return $mail->hasTo($userData['email']);
    });
});

it('allows guests to access free preview lessons', function () {
    $course = Course::factory()->create(['is_published' => true]);
    $lesson = Lesson::factory()->create([
        'course_id' => $course->id,
        'is_free_preview' => true,
        'order' => 1
    ]);

    get(route('lesson.show', ['course' => $course->slug, 'lesson' => $lesson->id]))
        ->assertOk() 
        ->assertSee($lesson->title); 
});

it('denies guests and unenrolled users from accessing locked lessons', function () {
    $course = Course::factory()->create(['is_published' => true]);
    $lesson = Lesson::factory()->create([
        'course_id' => $course->id,
        'is_free_preview' => false,
        'order' => 1
    ]);

    // Guest
    get(route('lesson.show', ['course' => $course->slug, 'lesson' => $lesson->id]))
        ->assertForbidden();

    // Unenrolled User
    $user = User::factory()->create();
    actingAs($user)
        ->get(route('lesson.show', ['course' => $course->slug, 'lesson' => $lesson->id]))
        ->assertForbidden();
});

it('enforces data isolation policies (User A cannot access User B\'s progress)', function () {
    $userA = User::factory()->create();
    $userB = User::factory()->create();

    $course = Course::factory()->create();
    $lesson = Lesson::factory()->create(['course_id' => $course->id]);

    // Create progress for User B
    $progressB = LessonProgress::create([
        'user_id' => $userB->id,
        'lesson_id' => $lesson->id,
        'started_at' => now(),
    ]);

    // Assert that User A cannot update User B's progress
    actingAs($userA);

    expect(Gate::allows('update', $progressB))->toBeFalse();

    // Explicitly test authorization check throws exception
    try {
        Gate::authorize('update', $progressB);
        $this->fail('AuthorizationException was not thrown');
    } catch (AuthorizationException $e) {
        expect(true)->toBeTrue();
    }
});
