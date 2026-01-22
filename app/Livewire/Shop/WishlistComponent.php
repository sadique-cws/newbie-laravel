<?php

namespace App\Livewire\Shop;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistComponent extends Component
{
    public $productId;
    public $isWishlisted = false;

    public function mount($products)
    {
        $this->productId = $products;

        if (Auth::check()) {
            $this->isWishlisted = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $this->productId)
                ->exists();
        }
    }

    public function wishlist()
    {
        if (!Auth::check()) {
            return;
        }

        $existing = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $this->productId)
            ->first();

        if ($existing) {
            $existing->delete();
            $this->isWishlisted = false;
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $this->productId,
            ]);
            $this->isWishlisted = true;
        }
    }

    public function render()
    {

        return view('livewire.shop.wishlist-component');
    }
}
