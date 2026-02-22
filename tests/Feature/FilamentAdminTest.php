<?php

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Livewire\Livewire;
use Filament\Facades\Filament;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\LevelResource;
use App\Filament\Resources\CourseResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Filament\Resources\UserResource\Pages\ViewUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Filament\Resources\CourseResource\Pages\EditCourse;

use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

it('denies non-admin users from accessing the filament admin panel', function () {
    $user = User::factory()->create(['is_admin' => false]);

    actingAs($user)
        ->get(Filament::getPanel('admin')->getUrl())
        ->assertForbidden();
});

it('allows admins to access the dashboard and render Level and Course resource pages', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    actingAs($admin)
        ->get(Filament::getPanel('admin')->getUrl())
        ->assertSuccessful();

    get(LevelResource::getUrl('index'))->assertSuccessful();
    get(CourseResource::getUrl('index'))->assertSuccessful();
    get(CourseResource::getUrl('create'))->assertSuccessful();
});

it('ensures the UserResource is strictly read-only', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    actingAs($admin);

    // Assert Index renders
    get(UserResource::getUrl('index'))->assertSuccessful();

    // Verify "Create" capability is disabled
    expect(UserResource::canCreate())->toBeFalse();

    // Verify "Create" page is not registered
    expect(array_key_exists('create', UserResource::getPages()))->toBeFalse();

    // Verify "Edit" page is not registered
    expect(array_key_exists('edit', UserResource::getPages()))->toBeFalse();

    // Ensure the "Create" action is not present on the List page
    Livewire::test(ListUsers::class)
        ->assertSuccessful()
        ->assertActionHidden('create'); // Standard Filament Create Action
});

it('renders the LessonsRelationManager within the Course Edit/View page', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $course = Course::factory()->create();

    actingAs($admin);

    // Use Livewire to test the Edit Page
    Livewire::test(EditCourse::class, ['record' => $course->getRouteKey()])
        ->assertSuccessful()
        ->assertSee('Lessons'); // Confirm the Relation Manager tab is present
});

it('renders Enrollment and Progress views successfully', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create();
    $course = Course::factory()->create(['title' => 'Advanced Laravel']);
    
    // Enroll the user
    $user->enrollments()->attach($course->id, ['enrolled_at' => now()]);

    actingAs($admin);

    // Use Livewire to test the View User Page (where Infolist with Enrollments is located)
    Livewire::test(ViewUser::class, ['record' => $user->getRouteKey()])
        ->assertSuccessful()
        ->assertSee($course->title)
        ->assertSee('0%'); // Initial progress
});
