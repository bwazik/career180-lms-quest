<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Traits\TruncatableTables;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    use TruncatableTables;

    public function run(): void
    {
        $this->truncateTables(['levels']);

        $levels = ['Beginner', 'Intermediate', 'Advanced'];

        foreach ($levels as $levelName) {
            Level::create(
                ['name' => $levelName]
            );
        }
    }
}
