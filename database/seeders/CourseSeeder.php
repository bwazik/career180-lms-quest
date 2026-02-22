<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Traits\TruncatableTables;
use Illuminate\Support\Facades\Storage;

class CourseSeeder extends Seeder
{
    use TruncatableTables;

    public function run(): void
    {
        $this->truncateTables(['courses', 'lessons', 'images']);

        $levels = Level::all();

        // Ensure we have levels
        if ($levels->isEmpty()) {
            $this->call(LevelSeeder::class);
            $levels = Level::select('name', 'slug')->get();
        }

        // Create 3 courses
        $courseData = [
            [
                'title' => 'HR Basics',
                'level' => 'Beginner',
                'desc' => 'This course is for the person who wants to get into HR career and want to know all about HR functions and responsibilities and steps to get into HR career.',
            ],
            [
                'title' => 'Fundamentals of Business Development',
                'level' => 'Beginner',
                'desc' => 'This course is for the person who wants to get into Business Development career and want to know all about Business Development functions and responsibilities and steps to get into Business Development career.',
            ],
            [
                'title' => 'Content Creation',
                'level' => 'Beginner',
                'desc' => 'This course explores the journey of content creation from personal storytelling to mastering platforms, algorithms, and building a powerful brand that grabs attention and drives results.',
            ],
            [
                'title' => 'How to Get a Scholarship',
                'level' => 'Intermediate',
                'desc' => 'This course guides students step by step through the process of applying for scholarships, from understanding different types and requirements to preparing the perfect application package and acing interviews. You’ll gain practical tools, real examples, and insider tips to increase your chances of winning scholarships.',
            ],
            [
                'title' => 'Non-Banking Financial Institutions',
                'level' => 'Intermediate',
                'desc' => 'This course introduces learners to the world of Non-Banking Financial Institutions (NBFIs), exploring their role in the financial system, the products they offer, and how they differ from traditional banks.',
            ],
            [
                'title' => 'How to Make a Marketing Plan',
                'level' => 'Advanced',
                'desc' => 'This course teaches students how to create a marketing plan that includes market research, target audience identification, competitive analysis, and strategy development. It covers key elements like pricing, promotion, and distribution to help businesses effectively market their products or services.',
            ],
            [
                'title' => 'Fundamentals of AI',
                'level' => 'Advanced',
                'desc' => 'This course provides an introduction to the field of artificial intelligence, covering the history, key concepts, and applications of AI. It explores how AI is transforming industries and the ethical considerations of AI development.',
            ],
        ];

        foreach ($courseData as $index => $data) {
            $level = $levels->firstWhere('name', $data['level']);

            $course = Course::firstOrCreate(
                ['title' => $data['title']],
                [
                    'level_id' => $level->id,
                    'description' => $data['desc'],
                    'is_published' => true,
                ]
            );

            $imageSource = database_path('seeders/images/courses/' . ($index + 1) . '.jpg');
            $imageName = Str::uuid() . '.jpg';
            $imageDestination = 'courses/' . $imageName;

            Storage::disk('public')->put(
                $imageDestination,
                file_get_contents($imageSource)
            );

            $course->image()->updateOrCreate(
                ['collection' => 'image'],
                [
                    'path' => $imageDestination,
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
        $videoUrl = 'videos/sample.mp4';

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
