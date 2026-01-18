<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.orders.index', [
            'orders' => Order::latest()->paginate(10),
        ]);
    }
}
