<?php

namespace App\Livewire\App;

use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.app')]
class UserProfile extends Component
{
    public function render()
    {
        return view('livewire.app.user-profile');
    }
}
