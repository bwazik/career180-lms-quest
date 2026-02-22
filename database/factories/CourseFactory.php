<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
            'level_id' => Level::factory(),
            'title' => $title,
            'description' => $this->faker->paragraph,
            'is_published' => $this->faker->boolean,
        ];
    }
}
