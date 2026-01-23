<?php

namespace App\Livewire\App;

use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.app')]

class UserAccounts extends Component
{
    public function render()
    {
        return view('livewire.app.user-accounts');
    }
}
