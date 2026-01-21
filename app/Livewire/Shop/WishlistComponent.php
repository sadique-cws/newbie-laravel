<?php

namespace App\Livewire\Shop;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistComponent extends Component
{
    public $isUserLiked = false;
    public $id = false;
    public function mount()
    {
        $isLiked = Wishlist::where('user_id', Auth::id())->where('product_id', $this->id)->first();
        if ($isLiked) {
            $this->isUserLiked = true;
        } else {
            $this->isUserLiked = false;
        }
    }
    public function toggleWishlist()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $isLiked = Wishlist::where('user_id', Auth::id())->where('product_id', $this->id)->first();
        $this->isUserLiked = $isLiked;
        if ($isLiked) {
            $isLiked->delete();
            $this->isUserLiked = false;
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $this->id
            ]);
            $this->isUserLiked = true;
        }
    }
    public function render()
    {
        return view('livewire.shop.wishlist-component');
    }
}
