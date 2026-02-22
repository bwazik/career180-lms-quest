<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LevelFactory extends Factory
{
    protected $model = Level::class;

    public function definition(): array
    {
        $name = $this->faker->word;
        return [
            'name' => ucfirst($name),
        ];
    }
}
