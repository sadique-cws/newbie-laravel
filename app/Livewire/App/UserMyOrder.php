<?php

namespace App\Livewire\App;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.app')]
class UserMyOrder extends Component
{
    public function render()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('livewire.app.user-my-order',compact('orders'));
    }
}
