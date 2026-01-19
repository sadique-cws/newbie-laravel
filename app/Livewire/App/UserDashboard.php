<?php

namespace App\Livewire\App;

use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.app')]
class UserDashboard extends Component
{
    public function render()
    {
        return view('livewire.app.user-dashboard');
    }
}
