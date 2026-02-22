<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'title' => $this->faker->sentence,
            'video_url' => 'videos/sample.mp4',
            'duration_seconds' => $this->faker->numberBetween(60, 3600),
            'order' => $this->faker->numberBetween(1, 100),
            'is_free_preview' => $this->faker->boolean,
        ];
    }
}
