<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Admin Dashboard')]
class Dashboard extends Component
{
    public $totalOrders;
    public $totalRevenue;
    public $totalCustomer;
    public $unVerifiedRetailer;
    public $recentOrder = [];

    public function mount()
    {
        $this->totalOrders = Order::count();
        $this->totalCustomer = User::count();
        $this->totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $this->unVerifiedRetailer = User::where('role', 'RETAILER')->where('is_verified', true)->count();
        $this->recentOrder = Order::latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}