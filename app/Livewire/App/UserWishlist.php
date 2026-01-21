<?php

namespace App\Livewire\App;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.app')]
class UserWishlist extends Component
{
    public function deleteWishlist($id){
        $wishlist = Wishlist::where('user_id', Auth::id())->where('product_id',$id)->first();
        $wishlist->delete();
    }
    public function render()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->get();
        return view('livewire.app.user-wishlist', [
            'wishlists' => $wishlists
        ]);
    }
}
