<?php

namespace App\Livewire\Retailer;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.retailer.dashboard');
    }
}
