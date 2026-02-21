<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Level;
use App\Models\Lesson;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $levels = Level::all();

        // Ensure we have levels
        if ($levels->isEmpty()) {
            $this->call(LevelSeeder::class);
            $levels = Level::select('name', 'slug')->get();
        }

        // Create 3 courses
        $courseData = [
            [
                'title' => 'Laravel for Beginners',
                'level' => 'Beginner',
                'desc' => 'Start your journey with Laravel framework.',
            ],
            [
                'title' => 'Advanced Eloquent Techniques',
                'level' => 'Advanced',
                'desc' => 'Master the power of Eloquent ORM.',
            ],
            [
                'title' => 'Building APIs with Laravel',
                'level' => 'Intermediate',
                'desc' => 'Learn how to build robust RESTful APIs.',
            ],
        ];

        foreach ($courseData as $data) {
            $level = $levels->firstWhere('name', $data['level']);

            $course = Course::firstOrCreate(
                ['title' => $data['title']],
                [
                    'level_id' => $level->id,
                    'description' => $data['desc'],
                    'is_published' => true,
                ]
            );

            $course->image()->updateOrCreate(
                ['collection' => 'image'],
                [
                    'path' => 'placeholders/course.jpg',
                    'disk' => 'public',
                    'sort_order' => 0,
                ]
            );

            // Create Lessons for this Course
            $this->createLessonsForCourse($course);
        }
    }

    private function createLessonsForCourse(Course $course): void
    {
        // Check if lessons already exist to avoid duplication
        if ($course->lessons()->count() > 0) {
            return;
        }

        $lessonCount = rand(3, 5);
        $videoUrl = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';

        for ($i = 1; $i <= $lessonCount; $i++) {
            Lesson::create([
                'course_id' => $course->id,
                'title' => "Lesson $i: Introduction to " . Str::limit($course->title, 20),
                'video_url' => $videoUrl,
                'duration_seconds' => rand(300, 1200),
                'order' => $i,
                'is_free_preview' => ($i === 1),
            ]);
        }
    }
}
