<?php

namespace App\Livewire\App;

use App\Models\Address;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.app')]
class UserDashboard extends Component
{
    public function render()
    {
        $totalOrders = Order::where('user_id', Auth::id())->count();
        $totalWishlist = Wishlist::where('user_id', Auth::id())->count();
        $totalAddress = Address::where('user_id', Auth::id())->count();
        $recentOrders = Order::where('user_id', Auth::id())->get();

        return view('livewire.app.user-dashboard', [
            'totalOrders' => $totalOrders,
            'totalWishlist' => $totalWishlist,
            'totalAddress' => $totalAddress,
            'recentOrders' => $recentOrders,
        ]);
    }
}
