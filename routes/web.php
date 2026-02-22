<?php

use App\Livewire\HomePage;
use App\Livewire\CourseShow;
use App\Livewire\LessonShow;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/courses/{slug}', CourseShow::class)->name('course.show');
Route::get('/courses/{course:slug}/lessons/{lesson}', LessonShow::class)->name('lesson.show');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
