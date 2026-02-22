<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\View\View;

#[Layout('layouts.master')]
class ProfilePage extends Component
{
    public function render(): View
    {
        return view('livewire.profile-page');
    }
}
