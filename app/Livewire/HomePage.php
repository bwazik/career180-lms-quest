<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\View\View;

#[Layout('layouts.master')]
class HomePage extends Component
{
    public function render(): View
    {
        $courses = Course::published()
            ->with(['level', 'image'])
            ->withCount('lessons')
            ->latest()
            ->get();

        return view('livewire.home-page', [
            'courses' => $courses,
        ]);
    }
}
