<?php

namespace App\Livewire\App;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class UserOrderView extends Component
{
    public $order;

    public function mount($order)
    {
        $this->order = Order::where('order_number', $order)
            ->where('user_id', Auth::id())
            ->with('items')
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.app.user-order-view');
    }
}
